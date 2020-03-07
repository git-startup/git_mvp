

function open_contacts_list () {
  var contacts = document.getElementById("contacts_list");
  if(contacts.style.display == "block"){
    contacts.style.display = "none";
  }
  elseif(contacts.style.display == "none"){
    contacts.style.display = "block";
  }

}
