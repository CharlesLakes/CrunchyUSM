<?php
class msgSwal
{
    private $msg;
    private $callback;

    function __construct()
    {
        $msg = FALSE;
    }

    function msg(array $opt, string $callback = "")
    {
        $this->msg = $opt;
        $this->callback = $callback;
    }

    function execute()
    {
        if ($this->msg) {
?>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
                swal(<?php echo json_encode($this->msg); ?>)
                    .then(<?php echo $this->callback; ?>);
            </script>
<?php
        }
    }
}


$Swal = new msgSwal();
