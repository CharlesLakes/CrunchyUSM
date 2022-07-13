$(function(){

    var processStatus = ()  => {
        if(initialStatus){
            $("#image-login").addClass("active");
            $(".register").addClass("active");
        }else{ 
            $("#image-login").removeClass("active");
            $(".register").removeClass("active");
        };
    };

    $(".toggle-status").click(()=>{
        initialStatus = !initialStatus;
        processStatus();
    })

    processStatus();
});
