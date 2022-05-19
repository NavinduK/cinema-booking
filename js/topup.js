function topupNow(userId, amount, topupId) {
    // alert(userId+" | " +amount+" | " +topupId)
    $.post('topupConfig.php', { userId: userId, amount: amount, topupId: topupId },
        function (res) {
            if (res == 1)
                window.location.replace("topupReq.php");
            else
                alert("Error occured!");
        });
}