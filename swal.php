<?php
class msgSwal
{
    private $msg;
    function __construct()
    {
        $msg = FALSE;
    }

    function msg(array $opt)
    {
        $this->msg = $opt;
    }

    function execute()
    {
        if ($this->msg) {
?>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
                swal(<?php echo json_encode($this->msg); ?>)
            </script>
<?php
        }
    }
}


$Swal = new msgSwal();
