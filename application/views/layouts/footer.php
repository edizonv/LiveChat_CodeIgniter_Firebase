<script src="<?php echo base_url().'assets/js/jquery.min.js' ?>"></script>
<script src="https://apis.google.com/js/client:platform.js?onload=renderButton" async defer></script>
<script src="<?php echo base_url().'assets/bootstrap/js/bootstrap.min.js' ?>"></script>
<script src="<?php echo base_url().'assets/js/script.js' ?>"></script>
<script>
function onSuccess(googleUser) {
  var profile = googleUser.getBasicProfile();
  gapi.client.load('plus', 'v1', function () {
    var request = gapi.client.plus.people.get({
        'userId': 'me'
    });
    //Display the user details
    request.execute(function (resp) {
       var postForm = {
          'user_name' : resp.displayName,
          'user_email' : resp.emails[0].value,
          'user_uname' : resp.name.givenName
        };

        $.ajax({
            url: "/users/insertGoogleInfo",
            type: "POST",
            data: postForm
        }).success(function(res) {
            window.location = "/main";
        });
        
    });
  });
}

function onFailure(error) {}

$(function() {
  $(window).load(function() {
    gapi.load('auth2', function() {
      gapi.auth2.init();
    });
  })
})

function renderButton() {
    gapi.signin2.render('gSignIn', {
        'scope': 'profile email',
        'width': 240,
        'height': 50,
        'longtitle': true,
        'theme': 'dark',
        'onsuccess': onSuccess,
        'onfailure': onFailure
    });
}

function signOut() {
    var auth2 = gapi.auth2.getAuthInstance().signOut();
    auth2.then(function () {
      console.log('User signed out.');
        window.location= "/users/login";
    });
}

var onLoad = function() {

    var dbRef = firebase.database().ref('chats');
    if (document.getElementById('loginAs')) {
      var getUserSessId = document.getElementById('loginAs').innerHTML;
    }
    dbRef.on('child_added', function(snapshot) {
        var data = snapshot.val(),
        $childData = document.createElement("p");
        if (data.chatName == getUserSessId) {
          $childData.className += data.chatName + ' ' + "me";
          $childData.innerHTML += "<span>" +data.chatMsg+"</span>";
        } else {
          $childData.className += data.chatName;
          $childData.innerHTML += "<b>"+data.chatName+ "</b><span>" +data.chatMsg+"</span>";
        }
        $childData.innerHTML += "<div class='chatDate'>"+data.chatDate+"</div>";
        document.getElementById("chatBody").append($childData);

       
    });

 

}
onLoad();

//insert user
function saveUser() {

  
  var uid = firebase.database().ref().child('chat').push().key,
      msg = document.getElementById('chatMsg').value;
      user = document.getElementById('user').value;
      if (msg == "") {
        msg = 'Guys im gay, and im proud of it!';
      }
      data = {
        chatId : uid,
        chatName : user,
        chatDate : new Date().toLocaleString(),
        chatMsg : msg
      },
      updates = {};
  updates['/chats/' + uid] = data;
  firebase.database().ref().update(updates);
  document.getElementById('chatMsg').value = "";


   var objDiv = document.getElementById("chatBody");
objDiv.scrollTop = objDiv.scrollHeight;

}


</script>
<noscript></noscript>
</body>
</html>