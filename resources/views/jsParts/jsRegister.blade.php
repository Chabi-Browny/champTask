<script type="text/javascript">

/**/
let TeamManager = function()
{
    this.teamWrapper = document.querySelector(".team-wrapper");
    this.teamWrapperChildSize = this.teamWrapper.children.length;
    this.lastTeam = this.teamWrapper.children[this.teamWrapperChildSize - 1];

    this.btnWrapper = document.querySelector(".action-btn-group");
    this.removeBtn = document.querySelector("[name='remove_team']");
    this.submitResultWrapper = document.querySelector(".submit-result");
    this.champNameField = document.querySelector("[name='champ_name']");

    this.teamPairs = [];
    this.teamList = [];
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
        this.btnWrapper.insertBefore(removeButton, this.btnWrapper.children[this.btnWrapper.children.length - 1]);
    }
    else if( this.removeBtn !== null && this.teamWrapperChildSize < 3)
    {
        this.btnWrapper.removeChild(this.removeBtn);
    }
};

/**/
let scoresBtn = function(id)
{
    TeamManager.call(this);

    let ScoreRegButton = document.createElement("a");
        ScoreRegButton.setAttribute("href", location.origin + "/scoreReg/" + id);
        ScoreRegButton.setAttribute("class","btn btn-info");
        ScoreRegButton.innerHTML = "Register scores";
        this.submitResultWrapper.appendChild(ScoreRegButton);
};

/**/
function addingTeam()
{
    event.preventDefault();

    TeamManager.call(this);

    let newTeamNumber = this.teamWrapperChildSize + 1,
    row = document.createElement("div");
    row.setAttribute("class","row  my-3");

    let teamNameDiv = el( "div", {  "class" : "col-4" }),
        teamNameInp = el(
            "input", {
                "class" : "form-control team-name",
                "name" : "tmname_" + newTeamNumber,
                "placeholder" : "Team " + newTeamNumber
            }
        );

        teamNameDiv.appendChild(teamNameInp);

    row.appendChild(teamNameDiv);

    let player1Div = el( "div", {  "class" : "col-4" }),
        player1 = el(
            "input", {
                "class" : "form-control player-one",
                "name" : "tmmember_" + newTeamNumber + "_p1",
                "placeholder" : "Player 1"
            }
        ),
        player2Div = el( "div", {  "class" : "col-4" }),
        player2 = el(
            "input", {
                "class" : "form-control player-two",
                "name" : "tmmember_" + newTeamNumber + "_p2",
                "placeholder" : "Player 2"
            }
        );

    player1Div.appendChild(player1);
    row.appendChild(player1Div);

    player2Div.appendChild(player2);
    row.appendChild(player2Div);

    this.teamWrapper.appendChild(row);

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

                if(teamFormItem.hasAttribute("name"))
                {
                    inputsName = teamFormItem.getAttribute("name").split("_");
                    let inputValue = teamFormItem.value.trim();

                    if (inputsName[0] === "tmname")
                    {
                        mappedTeam.tmname = inputValue;
                    }

                    if (inputsName[0] === "tmmember")
                    {
                        mappedTeam[inputsName[2]] = inputValue;
                    }
                }
            }
            teamList.push(mappedTeam);
        }

        TeamManager.teamList = teamList;

        // pairing the teams
        let teamPairs = [];
        for (let indx = 0; indx < teamList.length; indx++)
        {
            let current = teamList[indx];
            for (let ind = 0; ind < teamList.length - indx; ind++)
            {
                let currentPair = {};
                if (typeof teamList[ind+indx] !== "undefined" && current.tmname !== teamList[ind+indx].tmname)
                {
                    currentPair.team1 = current;
                    currentPair.team2 = teamList[ind+indx];

                    teamPairs.push(currentPair);
                }
            }
        }

        TeamManager.teamPairs = teamPairs;

        displayMatchList(teamPairs);
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
        wallElementLi.innerHTML = teamPairs[ndx].team1.tmname + " - " + teamPairs[ndx].team2.tmname;
        listWallUl.appendChild(wallElementLi);
    }
    listWallWrapper.appendChild(listWallUl);
}

/**/
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

    generateMachList();

    if (typeof TeamManager.teamList === "undefined")
    {
        alert("Missing value(s) in the form!");
        return false;
    }

    let csrfMetaContent = document.querySelector("[name='csrf-token']").getAttribute("content"),
        xhr = new XMLHttpRequest()
    ;

    // next time do this with fetch, not this old stuff - refactor this pls
    xhr.open("POST", "/champReg");
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader("Content-Type", "application/json; charset=UTF-8" );
    xhr.setRequestHeader("X-CSRF-TOKEN", csrfMetaContent );
    xhr.onreadystatechange = function ()
    {
        if (xhr.readyState === 4)
        {
            let resp = JSON.parse(xhr.responseText);

            if (xhr.status === 200 && typeof resp.success !== "undefined" )
            {
                infoResponse(resp);

                scoresBtn(resp.campId);
            }
            else if(xhr.status > 200)
            {
                errorResponse(resp);
            }
        }
    };
    xhr.send(JSON.stringify({ "teams": TeamManager.teamList,"teamsPairs": TeamManager.teamPairs, "champ_name": champName }));
}

/**/
function infoResponse(infoResp)
{
    responseEmitter(infoResp, "info");
}

/**/
function errorResponse(errorResp)
{
    responseEmitter(errorResp, "error");
}

/**/
function responseEmitter(response, reponseType)
{
    try
    {
        if (typeof reponseType === "undefined" || typeof reponseType === null || reponseType === "")
        {
            throw new Error("The response type can't be empty!");
        }

        TeamManager.call(this);

        let infoBox = document.createElement("div"),
            result = null
        ;

        let message = el(
                "p",
                reponseType === "info" ? response.success : response.message,
                { "class" : reponseType === "info" ? "alert alert-success" : "alert alert-danger" }
            );
        infoBox.appendChild(message);

        if (reponseType === "error")
        {
            for( let key in response.errors )
            {
                result = el(
                    "p",
                    response.errors[key][0],
                    {  "class" : "alert alert-danger" }
                );
                infoBox.appendChild(result);
            }
        }

        if (this.submitResultWrapper.hasChildNodes())
        {
            this.submitResultWrapper.innerHTML = "";
        }

        this.submitResultWrapper.appendChild(infoBox);
    }
    catch(error)
    {
        console.error(error);
    }
}

/**
 * @description It creates DOM element with addtional paramters
 * @param {string} domTag - DOM element which will be created
 * @param {object} attribs - atributum object for the DOM element
 * @returns {HTMLElement|el.element}
 */
function el(domTag, ...attribs)
{
    try
    {
        if ( domTag === "" || typeof domTag !== "string")
        {
            throw new Error("the domTag must be a string");
        }

        let element = document.createElement(domTag);

        for (let key in attribs)
        {
            if ( Object.prototype.toString.call( attribs[key] ) === "[object Object]" )
            {
                for(let objKey in attribs[key])
                {
                    element.setAttribute(objKey, attribs[key][objKey])
                }
            }

            if (typeof attribs[key] === "string" && attribs[key] !== "")
            {
                element.innerHTML = attribs[key];
            }
        }

        return element;
    }
    catch(error)
    {
        console.error(error);
    }
}

</script>