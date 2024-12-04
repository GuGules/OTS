<div class="container">
    <?php
    if (isset($_POST['submit'])) {
        $token = Message::genToken();
        while (!Message::testToken($token)) {
            $token = Message::genToken();
        }
        Message::saveMessage($token, $_POST['msg']);
    }
    ?>
    <div class="row">
        <div class="col-12">
            <h1>
                Nouveau Message
            </h1>
            <br>
            <form class="container-fluid" method="POST" action=" ">
                <div class="row">
                    <label for="msg">
                        Message :
                    </label>
                    <textarea type="text" name="msg" placeholder="Votre messsage ici..."></textarea>
                </div><br>
                <div class="row">
                    <button class="btn btn-primary" name="submit" type="submit">Enregistrer le message</button>
                </div>
            </form><br>
            <?php if (isset($token)){ ?>
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Well done!</h4>
                <p>Your secret's link is successfully generated.</p>
                <hr>
                <p class="mb-0">The secret message link is <a id="link" href="<?php echo Message::generateUrl($token)?>"><?php echo Message::generateUrl($token)?></a></p><br>
            </div>
            <button class ="btn btn-success" onclick="copyLink()"><i class="bi bi-copy"></i>&nbsp;Copy Link</button>  
            <?php } ?>
            <script src="include/app.js"></script>
        </div>
    </div>
</div>