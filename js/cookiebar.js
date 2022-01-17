(function($) {
    Drupal.behaviors.CookieBar = {
        attach: function(context, settings) {

            // DEFINE COOKIEBAR CONTENT
            const elCookieBar = document.getElementById("cookiebar");
            elCookieBar.innerHTML=`
            <div id="cookiebar-info" class="cookiebar-info">
                <p>De SP gebruikt cookies om het bezoek aan onze sites te meten. Deze gebruiken geen persoonsgegevens. Alleen als je toestemming geeft gebruiken we daarnaast cookies en scripts om advertenties af te stemmen op jouw interesses. Dan verwerken we wel persoonlijke gegevens over je bezoek. Meer informatie vind je op onze <a href="https://sp.nl/privacy">privacy pagina</a>.</p>
                <div>
                    <button id="cookiebar-functional" type="button">Alleen functioneel</button>
                    <button id="cookiebar-refuse" type="button">Niet akkoord</button>                  
                    <button class="accept" id="cookiebar-agree" type="button">Akkoord</button>
                </div>
            </div>`;

            // TOGGLE COOKIE BAR
            const elCookieInfo = document.getElementById("cookiebar-info");
            function toggleCookieBar() {
                if (elCookieInfo.style.display === "none"){
                    elCookieInfo.style.display = "block";
                } else {
                    elCookieInfo.style.display = "none";
                }
            }

            // CHECK IF LINK TO CHANGE PRIVACY SETTINGS IS PRESENT. IF NOT SHOW COOKIEBAR.
            const elShowPrivancySettings = document.getElementById("cookiebar-show");
            if (typeof elShowPrivancySettings !== 'undefined' && elShowPrivancySettings !== null){
                elShowPrivancySettings.addEventListener("click", toggleCookieBar, true);
            } else {
                console.log('The link to change privacy settings is missing!');
                toggleCookieBar(); // TODO: doesn't work
            }

            // ADD EVENTLISTENERS TO PRIVACY BUTTONS
            const elCookieAgree = document.getElementById("cookiebar-agree").addEventListener("click", cookieAgree, true);
            const elCookieFunctional = document.getElementById("cookiebar-functional").addEventListener("click", cookieFunctional, true);
            const elCookieRefuse = document.getElementById("cookiebar-refuse").addEventListener("click", cookieRefuse, true);
            
            // GET COOKIE INFO
            function getCookie(cname) {
                let name = cname + "=";
                let decodedCookie = decodeURIComponent(document.cookie);
                let ca = decodedCookie.split(';');
                for(let i = 0; i <ca.length; i++) {
                    let c = ca[i];
                    while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                    }
                    if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                    }
                }
                return "";
            }

            // CHECK IF PRIVACY COOKIE IS SET
            let privacy = getCookie("sprivacy");
            if(privacy != ""){
                console.log("sprivacy = " + privacy);
                elCookieInfo.style.display = "none"
            } else {
                console.log("sprivacy is not set");
                elCookieInfo.style.display = "block"
            }

            // SET COOKIE
            let now = new Date();
            let time = now.getTime();
            let expireTime = time + 90*86000000; // 90 days
            now.setTime(expireTime);
            let expires = "expires="+ now.toUTCString();

            // TODO: Refactor in single function
            // 2 = facebook + google analytics
            // 1 = google analytics
            // 0 = no tracking
            function cookieAgree(){
                document.cookie = "sprivacy=2; path=/;" + expires;
                console.log(document.cookie);
                toggleCookieBar();
                location.reload()
            }
            function cookieRefuse(){
                document.cookie = "sprivacy=1; path=/;" + expires;
                console.log(document.cookie);
                toggleCookieBar();
                location.reload()
            }
            function cookieFunctional(){
                document.cookie = "sprivacy=0; path=/;" + expires;
                console.log(document.cookie);
                toggleCookieBar();
                location.reload()
            }
        }
    };

})(jQuery);
