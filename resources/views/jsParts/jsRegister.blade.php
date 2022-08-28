<script type="text/javascript">

/**/
let TeamManager = function()
{
    this.teamWrapper = document.querySelector(".team-wrapper");
    this.teamWrapperChildSize = this.teamWrapper.children.length;
    this.lastTeam = this.teamWrapper.children[this.teamWrapperChildSize - 1];

    this.btnWrapper = document.querySelector(".action-btn-group");
    this.removeBtn = document.querySelector("[name='remove_team']");
    this.lotteryBtn = document.querySelector("[name='lottery']");
    this.champNameField = document.querySelector("[name='champ_name']");

    this.teamPairs = [];
    this.isTeamSizeChanged = false;
};

/*
 * @description It creates a remove button, depends team count size
 * @type void
 */
let removeBtn = function()
{
    TeamManager.call(this);

    if (this.removeBtn === null && this.teamWrapperChildSize >= 2 )
    {
        let removeButton = document.createElement("button");
        removeButton.setAttribute("name","remove_team");
        removeButton.setAttribute("class","btn btn-outline-danger");
        removeButton.setAttribute("onclick","removingTeam()");
        removeButton.innerHTML = "Remove Team";
        this.btnWrapper.insertBefore(removeButton, this.btnWrapper.children[this.btnWrapper.children.length - 2]);
    }
    else if( this.removeBtn !== null && this.teamWrapperChildSize < 3)
    {
        this.btnWrapper.removeChild(this.removeBtn);
    }
};

/**/
function addingTeam()
{
    event.preventDefault();

    TeamManager.call(this);

    let newTeamNumber = this.teamWrapperChildSize + 1,
    row = document.createElement("div");
    row.setAttribute("class","row");

    let teamNameDiv = document.createElement("div"),
        teamNameInp = document.createElement("input");

    teamNameDiv.setAttribute("class","col-4");
    teamNameInp.setAttribute("name", "tmn_" + newTeamNumber);
    teamNameInp.setAttribute("class", "form-control team-name");
    teamNameInp.value = "Team " + newTeamNumber;
    teamNameDiv.appendChild(teamNameInp);
    row.appendChild(teamNameDiv);

    let player1Div = document.createElement("div"),
        player1 = document.createElement("input"),
        player2Div = document.createElement("div"),
        player2 = document.createElement("input");

    player1.setAttribute("name", "tmm_" + newTeamNumber + "_p1");
    player1.setAttribute("class", "form-control player-one");
    player1.setAttribute("placeholder", "Player 1");
    player1Div.setAttribute("class","col-4");
    player1Div.appendChild(player1);
    row.appendChild(player1Div);

    player2.setAttribute("name", "tmm_" + newTeamNumber + "_p2" );
    player2.setAttribute("class", "form-control player-two");
    player2.setAttribute("placeholder", "Player 2");
    player2Div.setAttribute("class","col-4");
    player2Div.appendChild(player2);
    row.appendChild(player2Div);

    this.teamWrapper.appendChild(row);

    changeSubmitDisable(true);

    removeBtn();
};

/**/
function removingTeam()
{
    event.preventDefault();

    TeamManager.call(this);

    if (this.teamWrapperChildSize > 2)
    {
        this.teamWrapper.removeChild(this.lastTeam);
    }

    changeSubmitDisable(true);

    removeBtn();
}

/**/
function generateMachList()
{
    event.preventDefault();

    TeamManager.call(this);

    let lastTeamNumber = parseInt(this.lastTeam.children[0].children[0].getAttribute("name").split("_")[1]);

    if (lastTeamNumber === this.teamWrapperChildSize)
    {
        let teams = this.teamWrapper.children,
            teamList = []
        ;
        for (let idx = 0; idx < teams.length; idx++)
        {
            let mappedTeam = {};
            let team = teams[idx].children;

            for (let index = 0; index < team.length; index++)
            {
                let inputsName = null,
                    teamFormItem = team[index].children[0]
                ;
                if (teamFormItem.nodeName.toLowerCase() === "input" && teamFormItem.value === "")
                {
                    alert("Some field are empty. Please fill all the fields!");
                    return false;
                }

                if(teamFormItem.hasAttribute("name"))
                {
                    inputsName = teamFormItem.getAttribute("name").split("_");
                    let inputValue = teamFormItem.value.trim();

                    if (inputsName[0] === "tmn")
                    {
                        mappedTeam.teamId = inputValue;
                    }
                    if (inputsName[0] === "tmm")
                    {
                        mappedTeam[inputsName[2]] = inputValue;
                    }
                }
            }
            teamList.push(mappedTeam);
        }

        // pairing the teams
        let teamPairs = [];
        for (let indx = 0; indx < teamList.length; indx++)
        {
            let current = teamList[indx];
            for (let ind = 0; ind < teamList.length - indx; ind++)
            {
                let currentPar = {};
                if (typeof teamList[ind+indx] !== "undefined" && current.teamId !== teamList[ind+indx].teamId)
                {
                    currentPar.matchTeam1 = current;
                    currentPar.matchTeam2 = teamList[ind+indx];
                    teamPairs.push(currentPar);
                }
            }
        }
console.log(teamPairs);
        TeamManager.teamPairs = teamPairs;

        displayMatchList(teamPairs);

        changeSubmitDisable(false);
    }
};

/**/
function displayMatchList(teamPairs)
{
    let listWallWrapper = document.querySelector(".match-list-wall");
    let listWallUlWrapper = document.querySelector(".match-list-wall ul");
    if (listWallUlWrapper !== null)
    {
        listWallWrapper.removeChild(listWallUlWrapper);
    }

    let listWallUl = document.createElement("ul");
    for (let ndx = 0; ndx < teamPairs.length; ndx++)
    {
        let wallElementLi = document.createElement("li");
        wallElementLi.innerHTML = teamPairs[ndx].matchTeam1.teamId + " - " + teamPairs[ndx].matchTeam2.teamId;
        listWallUl.appendChild(wallElementLi);
    }
    listWallWrapper.appendChild(listWallUl);
}

/**/
function changeSubmitDisable(isDisable)
{
    let submitBtn = document.querySelector("[name='reg']");
    if (isDisable)
    {
        submitBtn.setAttribute("disabled", "disabled");
    }
    else
    {
        submitBtn.removeAttribute("disabled");
    }
}

function submitTeams()
{
    event.preventDefault();

    TeamManager.call(this);

    let champName = this.champNameField.value;

    if (typeof champName === "undefined" || champName === "")
    {
        alert("Please fill the championship name!");
        return false;
    }

    if (typeof TeamManager.teamPairs === "undefined")
    {
        alert("Please lottery the teams!");
        return false;
    }

    let csrfMetaContent = document.querySelector("[name='csrf-token']").getAttribute("content"),
    xhr = new XMLHttpRequest();

    xhr.open("POST", "/champReg");
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader("Content-Type", "application/json; charset=UTF-8" );
    xhr.setRequestHeader("X-CSRF-TOKEN", csrfMetaContent );
    xhr.onreadystatechange = function ()
    {
        if (xhr.readyState === 4 && xhr.status === 200 )
        {
            console.log("xhrthis",this);
            //if success redirect to
            console.log("xhrthis",xhr.responseText);
        }
    };
    xhr.send(JSON.stringify({"teamsPairs": TeamManager.teamPairs, "champName": champName }));
}

</script>