$(function(){

    var processStatus = ()  => {
        if(initialStatus)
            $("#image-login").addClass("active");
        else $("#image-login").removeClass("active");
    };

    $(".toggle-status").click(()=>{
        initialStatus = !initialStatus;
        processStatus();
    })

    processStatus();
});