<?php
/**
 * Copyright 2020 Google LLC.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
declare(strict_types=1);

namespace Google\Cloud\Samples\Functions\ConceptsEnvVars\Test;

use PHPUnit\Framework\TestCase;
use Google\Cloud\TestUtils\CloudFunctionLocalTestTrait;

require_once __DIR__ . '/TestCasesTrait.php';

/**
 * Class SystemTest.
 */
class SystemTest extends TestCase
{
    use CloudFunctionLocalTestTrait;
    use TestCasesTrait;

    private static $name = 'envVar';

    /**
      * @dataProvider cases
      */
    public function testFunction(
        $statusCode,
        $varName,
        $varValue
    ): void {
        // Check the target env variable
        $this->requireEnv($varName);

        // Send a request to the function.
        $resp = $this->client->get('/');

        // Assert status code.
        $this->assertEquals(
            $statusCode,
            $resp->getStatusCode()
        );

        // Assert function output.
        $expected = trim($varValue);
        $actual = trim((string) $resp->getBody());
        $this->assertEquals($expected, $actual);
    }
}
