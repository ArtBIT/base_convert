<? 

require_once dirname(__FILE__) . '/../base_convert.php';

/**
 * BaseConvertTest
 */
class BaseConvertTest extends PHPUnit_Framework_TestCase {

    /**
     * @test
     * @dataProvider provider_base_convert_checks
     */
    public function test_base_convert($value, $from_base, $to_base, $expected_result) {
        $result = math\base_convert($value, $from_base, $to_base);
        $this->assertEquals($result, $expected_result);
    }

    public function provider_base_convert_checks() {
        $data = array();
        // $data = array(
        //     ...
        //     array($value, $from_base, $to_base, $expected_result),
        //     ...
        // );
        foreach (array(2, 8, 16, 32) as $from_base) {
            foreach (array(11, 13, 17) as $to_base) {
                foreach (array(0, 1, -1, 1337, M_PI, 1234567890) as $value) {
                    $from_value = base_convert($value, 10, $from_base);
                    $expected_result = base_convert($from_value, $from_base, $to_base);
                    // Convert string to upper case since base36 or less is case insensitive
                    if ($to_base < 37) {
                        $expected_result = strtoupper($expected_result);
                    }
                    $data[] = array($from_value, $from_base, $to_base, $expected_result);
                }
            }
        }
        $data[] = array('19bWBI', 64, 10, '1234567890');
        // You can also use custom alphabets instead of integer bases
        // (since integer bases are expanded to alphabet strings anyways).
        // Here we convert from base 10 to alphabet 'customizable'
        $data[] = array(1234567890, 10, 'customizable', 'slmmmmcui');
        // Here we convert from alphabet 'customizable' to alphabet 'duplicates'
        $data[] = array('slmmmmcui', 'customizable', 'duplicates', 'uplicatesd');
        return $data;
    }

}

?>