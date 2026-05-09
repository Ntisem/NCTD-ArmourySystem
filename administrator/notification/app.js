$(document).ready(function() {

  //notification run/refresh every 5s
  showNotifications();
  setInterval(showNotifications, 5000);

  // hiding the notification message
  $("#notifications").hide();

  // show notification messages by clicking the btn
  $('#nf-btn').click(function(){
    $("#notifications").toggle();
 
  //change the notification number after seen 
    seenNotification();
  });
 

  // helps when the btn is click to show the message popup only
  $('#nf-btn').click(function(e){
      e.stopPropagation();
  })

   //toggle when ever the btn is clicked anywhere on the page
   $('html').click(function(){
    $("#notifications").hide()
 })
});

function showNotifications() {
    $.ajax({
        type: "POST",
        url: "fetch.php",
        data: {
            Key: '123'
        },
        cache: false,
        success: function (data) {
 
           //converting the data from json
            var data = JSON.parse(data);

            //storing data into another content 
            let contentData = data;
            
            //select notifications with id
            $('#notifications').html('');

              console.log(contentData);

            //check something inside all content data 
            if(contentData.length > 0){

                for (let i = 1; i < contentData.length; i++){

                    let noti_date = contentData[i].noti_date;
                    let noti_url = contentData[i].noti_date;
                    let noti_seen = contentData[i].noti_seen;
                    let noti_status = contentData[i].noti_status;
                    let noti_type = contentData[i].noti_type;
                    let noti_uniqueID = contentData[i].noti_uniqueID;
                    let noti_user_uniqueID = contentData[i].noti_user_uniqueID;
                    let noti_table = contentData[i].noti_table;
                    

                    if(noti_type = 'contact'){
                        noti_type = "You have a new Message";
                    }
                    if(noti_type = 'orders'){
                        noti_type = "You have an Order";
                    }
                    if(noti_seen == 'unseen'){
                        noti_seen = "Success";
                    }else{
                        noti_seen = 'dark';
                    }

                    let resultDiv = `
                       <a href="${noti_url}?notification=${noti_uniqueid}" >
                       <div class="alert alert-${noti_seen}" role="alert title="${noti_date}"> 
                       ${noti_type}
                       </div>
                       </a>
                    `;
                    //append this result div to the notification
                     $("#notifications").append(resultDiv);

                        //changing the html content to the number
                    $("#nf-n").html(contentData[0].total);
                }
            } 
            else{
                $("#notifications").html("<p>No Notification</p>")
            }


        },
        error: function(xhr, status, error){
            console.error(xhr);
        }
    })
}
// seen notification
function seenNotification(){
    $.ajax({
        type: "POST",
        url: "fetch.php",
        data:{
            key: '1234'
        },
        cache: false,
        success: function(data){

        }
    });
}