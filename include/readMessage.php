<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>
                Nouveau Message
            </h1>
            <br>
            <form class="container" method="POST" action=" ">
                <div class="row">
                    <label for="msg">
                        Message :
                    </label>
                    <textarea disabled type="text" name="msg" ><?php echo Message::readMessage($_GET['token'])?></textarea>
                </div><br>
            </form>
        </div>
    </div>
</div>