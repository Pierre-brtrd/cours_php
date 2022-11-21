<section id="contact">
    <div class="container">
        <h1>Restons en contact</h1>
        <hr class="separator middle">
        <div class="contact-content">
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Omnis, veritatis consequuntur? Porro laudantium vero, similique neque dicta voluptate amet veritatis doloremque, aspernatur maxime quae eum aliquid exercitationem quibusdam rerum impedit.</p>
            <div class="contact-form-content">
                <div class="contact-bg bg-1"></div>
                <div class="contact-bg bg-2"></div>
                <div class="contact-form">
                    <? if (!empty($_SESSION['status_email']) && !empty($_SESSION['response_email'])) : ?>

                        <? if ($_SESSION['status_email'] == "Success") : ?>
                            <div class="alert alert-success">
                                <p><?= $_SESSION['status_email']; ?>: <?= $_SESSION['response_email']; ?></p>
                            </div>
                        <? else : ?>
                            <div class="alert alert-danger">
                                <p><?= $_SESSION['status_email']; ?>: <?= $_SESSION['response_email']; ?></p>
                            </div>
                        <? endif; ?>

                        <?
                        unset($_SESSION['status_email']);
                        unset($_SESSION['response_email']);
                        ?>

                    <? endif; ?>
                    <h2>Envoyez-nous votre message</h2>
                    <form action="/templates/contact/sendEmail.php" method='POST'>
                        <div class="form-login-input">
                            <div class="form-row flex-start">
                                <div class="input-group">
                                    <label for="nom">Nom :</label>
                                    <input type="text" name="nom" placeholder="Votre nom">
                                </div>
                                <div class="input-group">
                                    <label for="email">Email :</label>
                                    <input type="email" name="email" placeholder="you@exemple.com">
                                </div>
                            </div>
                            <div class="form-row flex-start">
                                <div class="input-group">
                                    <label for="sujet">Sujet :</label>
                                    <input type="text" name="sujet" placeholder="Objet...">
                                </div>
                            </div>
                            <div class="form-row flex-start">
                                <div class="input-group textarea">
                                    <label for="message">Message :</label>
                                    <textarea name="message" placeholder="Message..."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="btn-contact">
                            <button class="btn btn-primary" type="submit">Envoyer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>