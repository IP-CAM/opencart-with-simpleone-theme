$( document ).ready(function() {

    $('[data-toggle="tooltip"]').tooltip();  
    $('[data-toggle="popover"]').popover();  

    $("#frmAddThought").submit(function(e) {

        //prevent Default functionality
        e.preventDefault();

        //get the action-url of the form
        var actionurl = e.currentTarget.action;
        var data = $("#frmAddThought").serialize();
        var comment = $("#frmAddThought #comment").val();
        //do your own request an handle the results
        $.ajax({
            url : actionurl,
            type : 'post',
            data : data,
            success : function(data) {
                var obj = JSON.parse(data);
                
                $("#modalMSGTitle").html("Success");
                $("#modalMSGBody").html("Your comment is submitted anonymously.");
                $("#modalMSG").modal();
                
                $("#frmAddThought")[0].reset();
            }, 
            error : function(data) {
                var obj = JSON.parse(data.responseText)
                //$("#divAddTag").append('<div class="alert alert-danger">' + data.msg + '</div>');
                $("#modalMSGTitle").html("Error");
                $("#modalMSGBody").html(obj.msg);
                $("#modalMSG").modal();
                $("#frmAddThought")[0].reset();
            }
        });

    });

   
    $( ".divTags" ).on('click', '.btn-vote', function() {
        var tagId = $(this).data('tagid');
        var tagIdCount = parseInt($(this).children(".badge").html());
        tagIdCount++;
        var btn = $(this);
        $.ajax({
            url : HOST + "user/add_vote",
            type : 'post',
            data : { tag_id: tagId, to_user_id: $("#user_id").val() },
            success : function(data) {
                btn.children(".badge").html(tagIdCount);
                btn.addClass("disabled");
            }, 
            error : function(data) {
                btn.addClass("disabled");
            }
        });   
    });

    $("#btnUPP").click(function(){
        $("#modalUPP").modal()
    });
    $("#btnAddComment").click(function(){
        $("#comment").focus()
    });
    
    $( "#divAllThoughts" ).on('click', '.publishThought', function() {
        //var thoughtId = $(this).data('thoughtid');
        var url = $(this).attr('href')
        $.ajax({
            url : url,
            type : 'GET',
            success : (data)=>{
                $(this).removeClass("publishThought");
                $(this).addClass("unpublishThought");
                $(this).attr('href', url.replace("publish", "unpublish"));
                $(this).html("Unpublish");
            }
        }); 
        return false; 
    });

    $( "#divAllThoughts" ).on('click', '.unpublishThought', function() {
        //var thoughtId = $(this).data('thoughtid');
        var url = $(this).attr('href')
        $.ajax({
            url : url,
            type : 'GET',
            success : (data)=> {
                $(this).removeClass("unpublishThought");
                $(this).addClass("publishThought");
                $(this).attr('href', url.replace("unpublish", "publish"));
                $(this).html("Publish")
            }
        }); 
        return false; 
    });

    $(".replyThought").click(function(){
        var thoughtId = $(this).data('thoughtid');
        $("#divReplyThought"+thoughtId).show(); 
        return false; 
    });

    $(".deleteThought").click(function(){
        
        var r = confirm("Do you want to delete?");

        if(r == false) {
            return false;
        }

        var thoughtId = $(this).data('thoughtid');
        var url = $(this).attr("href");
        $.ajax({
            //url : HOST + "home/deletethought/" + thoughtId,
            url : url,
            type : 'GET',
            success : (data)=> {
                $("#thoughtPost"+thoughtId).hide()
            }
        }); 
        return false; 
    });
    
    
    $( "#divAllThoughts" ).on('click', '.deleteReply', function() {
        
        var r = confirm("Do you want to delete?");

        if(r == false) {
            return false;
        }

        //var replyId = $(this).data('replyid');
        var url = $(this).attr("href")
        $.ajax({
            //url : HOST + "home/deletereply/" + replyId,
            url : url,
            type : 'GET',
            success : (data)=> {
                $(this).parent().hide()
            }
        }); 
        return false; 
    });

    $(".frmReplyThought").submit(function(e) {
         //prevent Default functionality
         e.preventDefault();

         //get the action-url of the form
         var actionurl = e.currentTarget.action;
         var data = $(this).serialize();
         var reply = $(this).find("#commentReply").val()

         $.ajax({
            url : actionurl,
            type : 'post',
            data : data,
            success : (data) => {
                var obj = JSON.parse(data);
                $(this).parent().html('<b>Your Reply</b><br/>'+reply);
            }, 
            error : function(data) {
                var obj = JSON.parse(data.responseText)
                //$("#divAddTag").append('<div class="alert alert-danger">' + data.msg + '</div>');
                $("#modalMSGTitle").html("Error");
                $("#modalMSGBody").html(obj.msg);
                $("#modalMSG").modal();
            }
        });
        
    });

    $(".btnShareCmnt").click(function(){
        var objSocialShareUrls = $(this).data('socialshareurls') ;
        $("#modalShareCmnt .fa-facebook-square").attr('href', objSocialShareUrls.facebook);
        $("#modalShareCmnt .fa-twitter-square").attr('href', objSocialShareUrls.twitter);
        $("#modalShareCmnt .fa-whatsapp-square").attr('href', objSocialShareUrls.whatsapp);
        $("#modalShareCmnt").modal()
    });
});

function getVoteDetails(tagId, userId) {
    $.ajax({
        url : HOST + "home/vote_details/"+tagId+"/"+userId,
        success : function(data) {
            var results = JSON.parse(data);
            console.log(results)
            var html = '<div class="container">';

            for(var i=0; i<results.length; i++) {
                html += '<div class="row"><div class="col-md">';
                html += '<h4><a href="'+HOST+'user/'+results[i]['user_id']+'">'+results[i]['first_name']+' '+results[i]['last_name']+'</a></h4>'
                html += '</div></div>';
            }
            html += '<div>';
            $("#modalVoteDetailsBody").html(html);
            $("#modalVoteDetails").modal()

        }, 
        error : function(data) {
            var obj = JSON.parse(data);
        }
    }); 
    return false;
}
