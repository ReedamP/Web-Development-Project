
function validateaddalbum(){ //Cannot have an input element (id) which contains matching letters to the name attribute, hence the name "namebox x"

  var title=document.getElementById('namebox2');
  var price=document.getElementById('namebox3');
  var genre=document.getElementById('namebox4');
  var artist=document.getElementById('namebox6');

  if (title.value==""){
    title.focus();
    title.style.border="solid 5px red";
  }
  if (artist.value=="Select"){
    artist.focus();
    artist.style.border="solid 5px red";
  }
  if (price.value==""){
    price.focus();
    price.style.border="solid 5px red";
  }
  if (genre.value==""){
    genre.focus();
    genre.style.border="solid 5px red";
  }

  if (title.value=="" || price.value=="" || genre.value=="" || artist.value=="Select" ){
    alert("Fields can not be left empty");
    return false;
  }
}

function validateartistname(){

  var addartistnamebox=document.getElementById('addartistnamebox');
  if (addartistnamebox.value==""){
    addartistnamebox.focus();
    addartistnamebox.style.border="solid 5px red";
    alert("Artist name can not be empty");
    return false;
  }
}

function validateaddtrack(){

  var title=document.getElementById('namebox8');
  var duration=document.getElementById('namebox9');
  var album=document.getElementById('namebox10');

  if (title.value==""){
    title.focus();
    title.style.border="solid 5px red";
  }
  if (duration.value==""){
    duration.focus();
    duration.style.border="solid 5px red";
  }
  if (album.value=="Select"){
    album.focus();
    album.style.border="solid 5px red";
  }

  if (title.value=="" || duration.value=="" || album.value=="Select"){
    alert("Fields can not be left empty");
    return false;
  }
}
