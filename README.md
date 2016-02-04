# CLI Parser
A lightweight command line arguments parser.

### Installation
```
composer require tyurderi/cli-parser
```

### Usage
``` php
$preParser = new CliParser\Cli\PreParser();
$result    = $preParser->parse('say_hello --message="Hello World"');

/**
 * $result looks like
 * 0: say_hello
 * 1: --message=Hello World
 *
 * This is almost the same output when you run these args through command line.
 * e.g. test.php say_hello --message="Hello World"
 */

$parser = new CliParser\Cli\PostParser();
$result = $parser->parse($result);

/**
 * $result looks like
 * __global__:
 *     0: say_hello
 *
 * message: Hello World
 */

```