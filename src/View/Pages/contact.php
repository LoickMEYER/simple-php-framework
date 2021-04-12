<div class="container">
    <h1>Contact</h1>

    <form method="POST">
        <input type="text" name="name" placeholder="Your name" class="form-control" />
        <textarea name="message" class="form-control mt-2" placeholder="Your message"></textarea>
        <button type="submit" class="btn btn-primary btn-sm mt-2">Send</button>
    </form>
</div>

<?php
if (!empty($name)) {
    echo 'Merci ' . $name;
}
?>