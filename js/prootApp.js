loadUsers(0,7);

function addEvents() {
    let users = document.querySelectorAll('.a-pseudo');
    for(var i=0; i<users.length; i++) {
        users[i].addEventListener('click', function(e) {
            e.preventDefault();
            loadArticles(this.getAttribute('value'), 0, 7);
        })
    }
}

function addButtonEventU() {
    let pn_button = document.querySelectorAll('.div-users .pn-button button');
    for(var j=0; j<pn_button.length; j++) {
        pn_button[j].addEventListener('click', function(e) {
            e.preventDefault();
            loadUsers(this.getAttribute('gl'), this.getAttribute('dl'));
        })
    }
}

function addButtonEventA() {
    let pn_button = document.querySelectorAll('.div-articles .pn-button button');
    for(var j=0; j<pn_button.length; j++) {
        pn_button[j].addEventListener('click', function(e) {
            e.preventDefault();
            loadArticles(this.getAttribute('own'), this.getAttribute('gl'), this.getAttribute('dl'));
        })
    }
}

function loadUsers(glimit, dlimit) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.querySelector(".div-users .content-stats").innerHTML = this.responseText;
            addEvents();
            addButtonEventU();
        } else if(this.readyState>0 && this.readyState<4) {
            document.querySelector(".div-users .content-stats").innerHTML = "Chargement ...";
        }
    };
    xhttp.open("GET", "users.php?gl=" + glimit + "&dl=" + dlimit, true);
    xhttp.send();
}


function loadArticles(owner, glimit, dlimit) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.querySelector(".div-articles .content-stats").innerHTML = this.responseText;
            addButtonEventA();
        } else if(this.readyState>0 && this.readyState<4) {
            document.querySelector(".div-articles .content-stats").innerHTML = "Chargement ...";
        }
    };
    xhttp.open("GET", "articles.php?own=" + owner + "&gl=" + glimit + "&dl=" + dlimit, true);
    xhttp.send();
}