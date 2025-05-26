<!-- Frontend layout -->
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newspaper</title>
    <link rel="stylesheet" href="<?php echo base_url('css/layout.css')?>">
 </head>
 <body>
    <header>
      <h1 class="example">this is header</h1>
    </header>

    <main>
        <?php echo $content; ?>
    </main>

    <footer>
      <h2>This is footer</h2>
    </footer>
 </body>
 </html>