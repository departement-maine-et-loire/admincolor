$.ajax({
url: CFG_GLPI.root_doc + '/' + GLPI_PLUGINS_PATH.admincolor + "/ajax/extract_json.php",
type: "GET",
dataType: "json",
success: function(data) {
    color1 = data[0]
    color2 = data[1]
    fontSizePolice = data[2]
    language = data[3]

    if (document.querySelector(".navbar-expand-xl") === null) {
      const headerAnchor = document.querySelector("body");

      const divAdminColor = document.createElement('div');
      divAdminColor.className = 'divAdminColor';
      divAdminColor.style.textAlign = 'center';
      divAdminColor.style.backgroundColor = color1;
      divAdminColor.style.position = 'relative';
      divAdminColor.style.top = '0';
      divAdminColor.style.left = '0';
      divAdminColor.style.right = '0';

      const adminColor = document.createElement('p');
      if(language === "fr-FR") {
        adminColor.innerText = `/!\\ Vous êtes actuellement connecté en tant que 'Super-Admin'`;
      } else if (language === "en-GB") {
        adminColor.innerText = `/!\\ You are currently logged in as 'Super-Admin'`;
      }
      adminColor.style.color = color2;
      adminColor.style.fontSize = fontSizePolice + "px";
      adminColor.style.fontWeight = "bold";
      adminColor.style.padding = "0.5rem";
      adminColor.style.margin = "0";

      headerAnchor.insertBefore(divAdminColor, document.querySelector('#messages_after_redirect'));
      divAdminColor.appendChild(adminColor);

      const divFollowingAdminColor = document.createElement('div');
      divFollowingAdminColor.style.textAlign = 'center';
      divFollowingAdminColor.style.backgroundColor = color1;
      divFollowingAdminColor.style.position = 'fixed';
      divFollowingAdminColor.style.zIndex = '1000000';
      divFollowingAdminColor.style.top = '0';
      divFollowingAdminColor.style.left = '0';
      divFollowingAdminColor.style.right = '0';

      const followingAdminColor = document.createElement('p');
      if(language === "fr-FR") {
        followingAdminColor.innerText = `/!\\ Vous êtes actuellement connecté en tant que 'Super-Admin'`;
      } else if (language === "en-GB") {
        followingAdminColor.innerText = `/!\\ You are currently logged in as 'Super-Admin'`;
      }
      followingAdminColor.style.color = color2;
      followingAdminColor.style.fontSize = fontSizePolice + "px";
      followingAdminColor.style.fontWeight = "bold";
      followingAdminColor.style.padding = "0.5rem";
      followingAdminColor.style.margin = "0";

      divAdminColor.insertBefore(divFollowingAdminColor, adminColor);
      divFollowingAdminColor.appendChild(followingAdminColor);

      document.querySelector('.navbar-vertical').style.top = fontSizePolice + "px";
    } 
    
    else if (document.querySelector(".navbar-vertical") === null) {
      const headerAnchor = document.querySelector(".navbar-expand-xl");

      const divAdminColor = document.createElement('div');
      divAdminColor.className = 'divAdminColor';
      divAdminColor.style.textAlign = 'center';
      divAdminColor.style.backgroundColor = color1;
      divAdminColor.style.position = 'relative';
      divAdminColor.style.top = '0';
      divAdminColor.style.left = '0';
      divAdminColor.style.right = '0';

      const adminColor = document.createElement('p');
      if(language === "fr-FR") {
        adminColor.innerText = `/!\\ Vous êtes actuellement connecté en tant que 'Super-Admin'`;
      } else if (language === "en-GB") {
        adminColor.innerText = `/!\\ You are currently logged in as 'Super-Admin'`;
      }
      adminColor.style.color = color2;
      adminColor.style.fontSize = fontSizePolice + "px";
      adminColor.style.fontWeight = "bold";
      adminColor.style.padding = "0";
      adminColor.style.margin = "0";

      document.querySelector('.page').insertBefore(divAdminColor, headerAnchor);
      divAdminColor.appendChild(adminColor);

      const divFollowingAdminColor = document.createElement('div');
      divFollowingAdminColor.style.textAlign = 'center';
      divFollowingAdminColor.style.backgroundColor = color1;
      divFollowingAdminColor.style.position = 'fixed';
      divFollowingAdminColor.style.zIndex = '1000000';
      divFollowingAdminColor.style.top = '0';
      divFollowingAdminColor.style.left = '0';
      divFollowingAdminColor.style.right = '0';

      const followingAdminColor = document.createElement('p');
      if(language === "fr-FR") {
        followingAdminColor.innerText = `/!\\ Vous êtes actuellement connecté en tant que 'Super-Admin'`;
      } else if (language === "en-GB") {
        followingAdminColor.innerText = `/!\\ You are currently logged in as 'Super-Admin'`;
      }
      followingAdminColor.style.color = color2;
      followingAdminColor.style.fontSize = fontSizePolice + "px";
      followingAdminColor.style.fontWeight = "bold";
      followingAdminColor.style.padding = "0";
      followingAdminColor.style.margin = "0";

      divAdminColor.insertBefore(divFollowingAdminColor, adminColor);
      divFollowingAdminColor.appendChild(followingAdminColor);

    }

    if (document.querySelector('.admincolorlanguage #AClanguage #ACFR') != null) {
        if (language === "fr-FR") {
        document.querySelector('.admincolorlanguage #AClanguage #ACFR').setAttribute('selected', "");
        } else if (language === "en-GB") {
        document.querySelector('.admincolorlanguage #AClanguage #ACEN').setAttribute('selected', "");
        }
    }
  },
    error: function(data) {
        console.log(data)
    }
});