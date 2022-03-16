function allowNumbers(e)
{
    var k = e.keyCode;
    return (k >= 48 && k <= 57);
};

var option=
{
    animation : true,
    delay : 2000,
    autohide : false
};

function showToast()
{
    var toastHTMLElement = document.getElementById("toast_id");

    var toastElement = new bootstrap.Toast(toastHTMLElement, option);

    toastElement.show();
};