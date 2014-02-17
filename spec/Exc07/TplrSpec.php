<?php

namespace spec\Exc07;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
/**
 *  Write a “template engine” meaning a way to transform template strings, “Hello {#name}” into “instanced” strings. To do that a variable->value mapping must be provided. For example, if name=”Cenk” and the template string is “Hello {#name}” the result would be “Hello Cenk”.
 *  - Should evaluate template single variable expression:
 *  mapOfVariables.put(“name”,”Cenk”);
 *  templateEngine.evaluate(“Hello {#name}”, mapOfVariables)
 *  =>   should evaluate to “Hello Cenk”
 *  - Should evaluate template with multiple expressions:
 *  mapOfVariables.put(“firstName”,”Cenk”);
 *  mapOfVariables.put(“lastName”,”Civici”);
 *  templateEngine.evaluate(“Hello {#firstName} {#lastName}”, mapOfVariables);
 *  =>   should evaluate to “Hello Cenk Civici”
 *  - Should give error if template variable does not exist in the map:
 *  map empty
 *  templateEngine.evaluate(“Hello {#firstName} “, mapOfVariables);
 *  =>   should throw missingvalueexception
 *  - Should evaluate complex cases:
 *  mapOfVariables.put(“name”,”Cenk”);
 *  templateEngine.evaluate(“Hello #{{#name}}”, mapOfVariables);
 *  =>   should evaluate to “Hello #{Cenk}”
 */
class TplrSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Exc07\Tplr');
    }

    function it_evaluates_template_single_variable_expression()
    {
        $this->evaluate('Hello {#name}', ['name' => 'Jacek'])->shouldBe('Hello Jacek');
    }

    function it_evaluates_template_with_multiple_expressions()
    {
        $this->evaluate(
            'Hello {#first_name} III {#last_name}',
            ['first_name' => 'Jacek', 'last_name' => 'Wysocki']
        )->shouldBe('Hello Jacek III Wysocki');
    }

    function it_gives_error_if_template_variable_does_not_exist_in_the_map()
    {
        $this->shouldThrow('\Exception')->duringEvaluate('Some {#name}');
    }

    function it_evaluates_complex_cases()
    {
        $this->evaluate('Hello #{{#name}}', ['name' => 'Misiak'])->shouldBe('Hello #{Misiak}');
    }

}
