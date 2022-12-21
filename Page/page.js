document.getElementById('submitButton').addEventListener('click', function () {

    $.ajax({
        url:'page-add.php',
        method:'POST',
        data:"titles" + encodeURIComponent("<?= $_GET['id'] ?>"),
        success: function (){
            document.getElementById('submitButton').classList.add('submitted');
        }
    })
})