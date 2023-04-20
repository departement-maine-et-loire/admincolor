var rootDoc = CFG_GLPI['root_doc'];
var admincolorRootDoc = rootDoc + '/plugins/admincolor';

  $.ajax({
  url: admincolorRootDoc + "/inc/getColor.php",
  type: "GET",
  dataType: "json",
  success: function(data) {
    color1 = data[0]
    color2 = data[1]
    fontSizePolice = data[2]
    language = data[3]
    
    const headAnchor = document.querySelector("body");
    const headerAnchor = document.querySelector("#header");
    
    const divAdminColor = document.createElement('div');
    divAdminColor.className = 'divAdminColor';
    divAdminColor.style.textAlign = 'center';
    divAdminColor.style.backgroundColor = color1;
    divAdminColor.style.position = 'relative';
    divAdminColor.style.padding = '0.05rem';
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

    headAnchor.insertBefore(divAdminColor, headerAnchor);
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

    divAdminColor.appendChild(divFollowingAdminColor);
    divFollowingAdminColor.appendChild(followingAdminColor);

    if(document.querySelector('.admincolorlanguage #AClanguage') !== null) {
      if (language === "fr-FR") {
        document.querySelector('.admincolorlanguage #AClanguage #ACFR').setAttribute('selected', "");
      } else if (language === "en-GB") {
        document.querySelector('.admincolorlanguage #AClanguage #ACEN').setAttribute('selected', "");
      }
    }
  },
  error: function(data) {
      console.log("erreur")
  }
  });