<?php

require_once('core/header.php');

use Cranberry\Markdown;

$md = new Markdown();
echo $md->text("# Test\n* list\n* ite*m* **2**\n\n![alt text](https://github.com/adam-p/markdown-here/raw/master/src/common/images/icon48.png)\n\n| Tables        | Are           | Cool  |\n| ------------- |:-------------:| -----:|\n| col 3 is      | right-aligned | $1600 |\n| col 2 is      | centered      |   $12 |\n| zebra stripes | are neat      |    $1 |\n\n## <<>&\n\n<https://github.com/itsmaxymoo>");

?>



<?php

require_once('core/footer.php');

?>
