var page = 0;

let nextPage = document.getElementById("nextPage");
let user_pagination = new XMLHttpRequest();

user_pagination.onload = function() {
    if (this.responseText.length == 0) {
        let elem = document.getElementById('nextPage');

        let p = document.createElement('p');
        p.className = "text-center"
        p.innerHTML = 'Nothing else to show';
        elem.parentNode.appendChild(p);

        elem.parentNode.removeChild(elem);
        return
    }
    document.getElementById("user_review_section").innerHTML += this.responseText;
    start_likes();

};
if (nextPage != null) {
    nextPage.addEventListener('click', () => {
        page += 1;
        user_pagination.open("GET", "/api/user/" + user_id + "/feed/" + page, true);
        user_pagination.send();
    });
}

window.onscroll = function(ev) {
    if (nextPage != null)
        if ((window.innerHeight + window.pageYOffset) >= document.body.offsetHeight) {
            nextPage.click();
        }
};