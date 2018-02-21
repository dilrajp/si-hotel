<!DOCTYPE html>
<html ng-app="angular">
  <head>
    <?php display("slices/style") ?>

    <script>
      var baseurl = "<?php echo base_url() ?>";
      var section = "<?php echo $section ?>";
    </script>
  </head>
  <body>
    <?php display("slices/header") ?>

    <div class="wrapper">
      <div class="container" ng-controller="dataController">
        <?php display($content) ?>

        <?php display("slices/footer") ?>
      </div>
    </div>

    <?php display("slices/script") ?>
  </body>
</html>
