<?php
declare(strict_types=1);

namespace BCMathExtended\Tests\Unit;

use BCMathExtended\BC;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class BCTest extends TestCase
{
    public function scientificNotationProvider(): array
    {
        return [
            ['0', '-0'],
            ['0', ''],
            ['666', '666'],
            ['-666', '-666'],
            [
                '99999999999999999999999999999999999.000000000000000000000',
                '99999999999999999999999999999999999.000000000000000000000',
            ],
            [
                '99999999999999999999999999999999999.999999999999999999999',
                '99999999999999999999999999999999999.999999999999999999999',
            ],
            ['1000000000000000000000000000000', 1.0E+30],
            ['-1540000000000000', -1.54E+15],
            ['1540000000000000', 1.54E+15],
            ['602200000000000000000000', '6.022E+23'],
            ['602200000000000000000000', '6.022e+23'],
            ['-602200000000000000000000', '-6.022e+23'],
            ['-602200000000000000000000', '-6.022E+23'],
            ['1999.99', '19.9999E+2'],
            ['0.00000000001', 1.0E-11],
            ['0.0000051', 5.1E-6],
            ['-0.00051', -5.1E-4],
            ['0.02', 2E-2],
            ['0.0021', 2.1E-3],
            ['0.00000003', 3E-8],
            ['0.000000657', 6.57E-7],
            ['5', '5e+0'],
            ['-5', '-5e+0'],
            ['5.254', 5.254e+0],
            ['8853.6719', 8.8536719e+3],
            ['0.00000000001', '0.00000000001'],
            ['-0.00116000', '-0.00116000'],
            ['-26.2912940386', -2.62912940386e+1],
            ['2.6', 2.6e+0],
            ['1734825599220.52', '1.73482559922052e+12'],
            ['-57170562.129942072027205098329198887303', '-5.7170562129942072027205098329198887303e+7'],
            ['0.000021', '2.1e-5'],
            ['0.7811084054', '7.811084054e-1'],
            ['0', '0e+0'],
            ['-1.1', '-1.1e+0'],
            ['-4.182', '-4.182e+0'],
            ['23.07', '2.307e+1'],
            ['-2349', '-2.349e+3'],
            ['-230807.1307795', '-2.308071307795e+5'],
            ['-887126.1', '-8.871261e+5'],
            [
                '-0.40559318155029357183161762311247760893712676112986144952',
                '-4.0559318155029357183161762311247760893712676112986144952e-1',
            ],
            [
                '-749168762.7771507445838618797279002344648652959333491',
                '-7.491687627771507445838618797279002344648652959333491e+8',
            ],
            ['1.3333', '0.13333e+01'],
            ['100', '1e+2'],
            // some rubbish..
            ['23', '23.1.23.0e+0..3123131'], //hmm
            ['345600000000', '3.456e11'],
            ['345600000000', 3.456e11],
            ['-345600000000', '-3.456e11'],
            ['-345600000000', -3.456e11],

        ];
    }

    /**
     * @test
     * @dataProvider scientificNotationProvider
     * @param string $expected
     * @param mixed $number
     */
    public function shouldConvertScientificNotationToString($expected, $number): void
    {
        self::assertSame($expected, BC::convertScientificNotationToString((string)$number));
    }

    public function ceilProvider(): array
    {
        return [
            ['0', -0],
            ['-1', -1],
            ['-1', -1.5],
            ['-1', -1.8],
            ['-2', -2.7],
            ['0', 0],
            ['1', 0.5],
            ['1', 1],
            ['2', 1.5],
            ['2', 1.8],
            ['3', 2.7],
            ['0', '-0'],
            ['0', ''],
            ['0', null],
            ['20000', '2/0000'],
            ['-60000', '-6/0000'],
            ['1000000000000000000000000000000', '+1/000000000000000000000000000000'],
            ['99999999999999999999999999999999999', '99999999999999999999999999999999999.000000000000000000000'],
            ['100000000000000000000000000000000000', '99999999999999999999999999999999999.999999999999999999999'],
            ['0', '0-'],
            ['100000000000000000000000000000000000', 1.0E+35],
            ['-100000000000000000000000000000000000', -1.0E+35],
            ['1', 3E-8],
            ['1', 1.0E-11],
        ];
    }

    /**
     * @test
     * @param string $expected
     * @param mixed $number
     * @dataProvider ceilProvider
     */
    public function shouldCeil($expected, $number): void
    {
        self::assertSame($expected, BC::ceil((string)$number));
    }

    public function floorProvider(): array
    {
        return [
            ['0', -0],
            ['-1', -0.5],
            ['-1', -1],
            ['-2', -1.5],
            ['-2', -1.8],
            ['-3', -2.7],
            ['0', 0],
            ['0', 0.5],
            ['1', 1],
            ['1', 1.5],
            ['1', 1.8],
            ['2', 2.7],
            ['0', '-0'],
            ['0', ''],
            ['0', null],
            ['20000', '2/0000'],
            ['-60000', '-6/0000'],
            ['1000000000000000000000000000000', '+1/000000000000000000000000000000'],
            [
                '99999999999999999999999999999999999',
                '99999999999999999999999999999999999.000000000000000000000',
            ],
            [
                '99999999999999999999999999999999999',
                '99999999999999999999999999999999999.999999999999999999999',
            ],
            ['0', '0-'],
            ['100000000000000000000000000000000000', 1.0E+35],
            ['-100000000000000000000000000000000000', -1.0E+35],
            ['0', 3E-8],
            ['0', 1.0E-11],
        ];
    }

    /**
     * @test
     * @dataProvider floorProvider
     * @param string $expected
     * @param int|float|string $number
     */
    public function shouldFloor($expected, $number): void
    {
        self::assertSame($expected, BC::floor((string)$number));
    }

    public function absProvider(): array
    {
        return [
            ['1', -1],
            ['1.5', -1.5],
            ['1', '-1'],
            ['1.5', '-1.5'],
            [
                '9999999999999999999999999999999999999999999999999999999',
                '-9999999999999999999999999999999999999999999999999999999',
            ],
            ['0', '-0'],
            ['0', ''],
            ['0', null],
            ['20000', '2/0000'],
            ['60000', '-6/0000'],
            ['1000000000000000000000000000000', '+1/000000000000000000000000000000'],
            ['0', '0-'],
            ['100000000000000000000000000000000000', 1.0E+35],
            ['100000000000000000000000000000000000', -1.0E+35],
            ['0.0000051', -5.1E-6],
        ];
    }

    /**
     * @test
     * @dataProvider absProvider
     * @param string $expected
     * @param int|float|string $number
     */
    public function shouldAbs($expected, $number): void
    {
        self::assertSame($expected, BC::abs((string)$number));
    }

    public function roundProvider(): array
    {
        return [
            ['3', '3.4'],
            ['4', '3.5'],
            ['4', '3.6'],
            ['2', '1.95583'],
            ['2', '1.95583'],
            ['1.96', '1.95583', 2],
            ['1.956', '1.95583', 3],
            ['1.9558', '1.95583', 4],
            ['1.95583', '1.95583', 5],
            ['1241757', '1241757'],
            ['1241757', '1241757', 5],
            ['-3', '-3.4'],
            ['-4', '-3.5'],
            ['-4', '-3.6'],
            ['123456.745671', '123456.7456713', 6],
            ['1', '1.11'],
            ['1.11', '1.11', 2],
            ['0.1666666666667', '0.1666666666666665', 13],
            ['0', '0.1666666666666665', 0],
            ['10', '9.999'],
            ['10', '9.999', 2],
            ['0.01', '0.005', 2],
            ['0.02', '0.015', 2],
            ['0.03', '0.025', 2],
            ['0.04', '0.035', 2],
            ['0.05', '0.045', 2],
            ['0.06', '0.055', 2],
            ['0.07', '0.065', 2],
            ['0.08', '0.075', 2],
            ['0.09', '0.085', 2],
            ['77777777777777777777777777777', '77777777777777777777777777777.1'],
            [
                '100000000000000000000000000000000000',
                '99999999999999999999999999999999999.99999999999999999999999999999999991',
            ],
            [
                '99999999999999999999999999999999999',
                '99999999999999999999999999999999999.00000000000000000000000000000000001',
            ],
            ['99999999999999999999999999999999999', '99999999999999999999999999999999999.000000000000000000000'],
            ['0', '-0'],
            ['0', ''],
            ['0', null],
            ['20000', '2/0000'],
            ['-60000', '-6/0000'],
            ['1000000000000000000000000000000', '+1/000000000000000000000000000000'],
            ['0', '0-'],
            ['100000000000000000000000000000000000', 1.0E+35],
            ['-100000000000000000000000000000000000', -1.0E+35],
            ['0', 3E-8],
            ['0', 1.0E-11],
            ['-0.0006', -5.6E-4, 4],
            ['0.000000001', 9.9999E-10, 10],
        ];
    }

    /**
     * @test
     * @dataProvider roundProvider
     * @param string $expected
     * @param int|float|string $number
     * @param int $precision
     */
    public function shouldRound($expected, $number, $precision = 0): void
    {
        self::assertSame($expected, BC::round((string)$number, $precision));
    }


    public function randProvider(): array
    {
        return [
            [1, 3],
            ['432423432423423423423423432432423423423', '999999999999999999999999999999999999999999'],
        ];
    }

    /**
     * @test
     * @param string|int $left
     * @param string|int $right
     * @dataProvider randProvider
     */
    public function shouldRand($left, $right): void
    {
        $rand = BC::rand((string)$left, (string)$right);
        self::assertTrue($rand >= $left);
        self::assertTrue($rand <= $right);
    }

    /**
     * @test
     */
    public function shouldMax(): void
    {
        self::assertSame('3', BC::max(1, 2, 3));
        self::assertSame('6', BC::max(6, 3, 2));
        self::assertSame('999', BC::max(100, 999, 5));

        self::assertSame('677', BC::max([3, 5, 677]));
        self::assertSame('-3', BC::max([-3, -5, -677]));

        self::assertSame(
            '999999999999999999999999999999999999999999',
            BC::max(
                '432423432423423423423423432432423423423',
                '999999999999999999999999999999999999999999',
                '321312312423435657'
            )
        );
        self::assertSame('0.00000000099999', BC::max(9.9999E-10, -5.6E-4));
    }

    /**
     * @test
     */
    public function shouldMin(): void
    {
        self::assertSame('7.20', BC::min('7.30', '7.20'));
        self::assertSame('3', BC::min([3, 5, 677]));
        self::assertSame('-677', BC::min([-3, -5, -677]));

        self::assertSame(
            '321312312423435657',
            BC::min(
                '432423432423423423423423432432423423423',
                '999999999999999999999999999999999999999999',
                '321312312423435657'
            )
        );

        self::assertSame('-0.00056', BC::min(9.9999E-10, -5.6E-4));
    }


    public function setScaleProvider(): array
    {
        return [
            [50, '3', '1', '2'],
            [0, '3', '1', '2'],
            [13, '3', '1', '2'],
        ];
    }

    /**
     * @test
     * @dataProvider setScaleProvider
     * @param int|null $scale
     * @param string $expected
     * @param string $left
     * @param string $right
     */
    public function shouldSetScale($scale, $expected, $left, $right): void
    {
        BC::setScale($scale);
        self::assertSame($expected, BC::add($left, $right));
    }

    public function roundUpProvider(): array
    {
        return [
            ['663', 662.79],
            ['662.8', 662.79, 1],
            ['60', 54.1, -1],
            ['60', 55.1, -1],
            ['-23.6', -23.62, 1],
            ['4', 3.2],
            ['77', 76.9],
            ['3.142', 3.14159, 3],
            ['-3.1', -3.14159, 1],
            ['31500', 31415.92654, -2],
            ['31420', 31415.92654, -1],
            ['0.0119', 0.0119, 4],
            ['0', '-0'],
            ['0', ''],
            ['0', null],
            ['0', '0-'],
            ['1', 9.9999E-10],
        ];
    }

    /**
     * @test
     * @dataProvider roundUpProvider
     * @param string $expected
     * @param int|float|string $number
     * @param int $precision
     */
    public function shouldRoundUp($expected, $number, $precision = 0): void
    {
        self::assertSame($expected, BC::roundUp((string)$number, $precision));
    }

    public function roundDownProvider(): array
    {
        return [
            ['662', 662.79],
            ['662.7', 662.79, 1],
            ['50', 54.1, -1],
            ['50', 55.1, -1],
            ['-23.7', -23.62, 1],
            ['3', 3.2],
            ['76', 76.9],
            ['3.141', 3.14159, 3],
            ['-3.2', -3.14159, 1],
            ['31400', 31415.92654, -2],
            ['31410', 31415.92654, -1],
            ['0.0119', 0.0119, 4],
            ['0', '-0'],
            ['0', ''],
            ['0', null],
            ['0', '0-'],
            ['0', 9.9999E-10],
        ];
    }

    /**
     * @test
     * @dataProvider roundDownProvider
     * @param string $expected
     * @param int|float|string $number
     * @param int $precision
     */
    public function shouldRoundDown($expected, $number, $precision = 0): void
    {
        self::assertSame($expected, BC::roundDown((string)$number, $precision));
    }

    public function addProvider(): array
    {
        return [
            ['3', '1', '2'],
            ['2', '1', '1'],
            ['15', '10', '5'],
            ['2.05', '1', '1.05', 2],
            ['4', '-1', '5', 4],
            ['8728932003911564969352217864684', '1928372132132819737213', '8728932001983192837219398127471', 2],
            ['-0.00055999', 9.9999E-10, -5.6E-4, 8],
            ['15.000000000000311', '3.11e-13', '15', 15],
            ['3110000015', '3.11e9', '15', 0],
        ];
    }

    /**
     * @test
     * @param int|null $scale
     * @param string $expected
     * @param string $left
     * @param string $right
     * @dataProvider addProvider
     */
    public function shouldAdd($expected, $left, $right, $scale = 0): void
    {
        self::assertSame($expected, BC::add((string)$left, (string)$right, $scale));
    }

    /**
     * @test
     */
    public function shouldAddUsingGlobalScale(): void
    {
        BC::setScale(0);
        self::assertSame('2', BC::add('1', '1.05'));
        self::assertSame('2.05', BC::add('1', '1.05', 2));
        BC::setScale(2);
        self::assertSame('2', BC::add('1', '1.05', 0));
        self::assertSame('2.05', BC::add('1', '1.05'));
    }

    /**
     * @test
     */
    public function shouldSubUsingGlobalScale(): void
    {
        BC::setScale(0);
        self::assertSame('-1', BC::sub('1', '2.5'));
        self::assertSame('-1.5', BC::sub('1', '2.5', 2));
        BC::setScale(2);
        self::assertSame('-1', BC::sub('1', '2.5', 0));
        self::assertSame('-1.5', BC::sub('1', '2.5'));
    }

    public function subProvider(): array
    {
        return [
            ['-1', '1', '2'],
            ['0', '1', '1'],
            ['5', '10', '5'],
            ['-1.5', '1', '2.5', 2],
            ['-6', '-1', '5', 4],
            ['8728932000054820705086578390258', '8728932001983192837219398127471', '1928372132132819737213', 2],
            ['0.00056', 9.9999E-10, -5.6E-4, 8],
        ];
    }

    /**
     * @test
     * @param int|null $scale
     * @param string $expected
     * @param string $left
     * @param string $right
     * @dataProvider subProvider
     */
    public function shouldSub($expected, $left, $right, $scale = 0): void
    {
        self::assertSame($expected, BC::sub((string)$left, (string)$right, $scale));
    }

    public function compProvider(): array
    {
        return [
            ['-1', '5', BC::COMPARE_RIGHT_GRATER, 4],
            ['1928372132132819737213', '8728932001983192837219398127471', BC::COMPARE_RIGHT_GRATER, 1],
            ['1.00000000000000000001', '2', BC::COMPARE_RIGHT_GRATER, 1],
            [97321, 1, BC::COMPARE_LEFT_GRATER, 2],
            [1, 0, BC::COMPARE_LEFT_GRATER, 0],
            [1, 1, BC::COMPARE_EQUAL, 0],
            [0, 1, BC::COMPARE_RIGHT_GRATER, 0],
            ['1', '0', BC::COMPARE_LEFT_GRATER, 0],
            ['1', '1', BC::COMPARE_EQUAL, 0],
            ['0', '1', BC::COMPARE_RIGHT_GRATER, 0],
            ['1', '0.0005', BC::COMPARE_LEFT_GRATER, 4],
            ['1', '0.000000000000000000000000005', BC::COMPARE_LEFT_GRATER, 2],
        ];
    }

    /**
     * @test
     * @dataProvider compProvider
     * @param string|int $left
     * @param string|int $right
     * @param int $expected
     * @param int $scale
     */
    public function shouldComp($left, $right, $expected, $scale): void
    {
        self::assertSame($expected, BC::comp((string)$left, (string)$right, $scale));
    }

    public function getScaleProvider(): array
    {
        return [
            [10],
            [25],
            [0],
        ];
    }

    /**
     * @test
     * @param int $expected
     * @dataProvider getScaleProvider
     */
    public function shouldGetScale($expected): void
    {
        BC::setScale($expected);

        self::assertSame($expected, BC::getScale());
    }

    public function divProvider(): array
    {
        return [
            ['0.5', '1', '2', 2],
            ['-0.2', '-1', '5', 4],
            ['4526580661.75', '8728932001983192837219398127471', '1928372132132819737213', 2],
            ['0.000000000099999', '9.9999E-10', '10', 15],
        ];
    }

    /**
     * @test
     * @dataProvider divProvider
     * @param string $expected
     * @param string $left
     * @param string $right
     * @param int $scale
     */
    public function shouldDiv($expected, $left, $right, $scale): void
    {
        self::assertSame($expected, BC::div((string)$left, (string)$right, $scale));
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Division by zero
     */
    public function shouldThrowDivByZero(): void
    {
        BC::div('1', '0');
    }

    /**
     * @test
     */
    public function shouldDivUsingGlobalScale(): void
    {
        BC::setScale(0);
        self::assertSame('0', BC::div('1', '2'));
        self::assertSame('0.5', BC::div('1', '2', 2));
        BC::setScale(2);
        self::assertSame('0', BC::div('1', '2', 0));
        self::assertSame('0.5', BC::div('1', '2'));
    }

    public function modProvider(): array
    {
        return [
            ['1', '11', '2', 0],
            ['-1', '-1', '5', 0],
            ['1459434331351930289678', '8728932001983192837219398127471', '1928372132132819737213', 0],
            ['0', 9.9999E-10, 1, 0],
            ['0.5', 10.5, 2.5, 2],
            ['0.5', 10.5, 2.5, 2],
            ['0.8', '10', '9.2', 1],
            ['0', '20', '4.0', 1],
            ['0', '10.5', '3.5', 1],
            ['0.3', '10.2', '3.3', 1],
            ['-0.000559999', 9.9999E-10, -5.6E-4, 9],
        ];
    }

    /**
     * @test
     * @dataProvider modProvider
     * @param string $expected
     * @param string $left
     * @param string $right
     * @param int $scale
     */
    public function shouldMod($expected, $left, $right, $scale): void
    {
        self::assertSame($expected, BC::mod((string)$left, (string)$right, $scale));
    }


    public function mulProvider(): array
    {
        return [
            ['1', '1.5', '1.5', 1],
            ['10', '1.2500', '12.5', 2],
            ['100', '0.29', '29', 0],
            ['100', '0.029', '2.9', 1],
            ['100', '0.0029', '0.29', 2],
            ['1000', '0.29', '290', 0],
            ['1000', '0.029', '29', 0],
            ['1000', '0.0029', '2.9', 1],
            ['2000', '0.0029', '5.8', 1],
            ['1', '2', '2', 2],
            ['-3', '5', '-15', 2],
            ['1234567890', '9876543210', '12193263111263526900', 2],
            ['2.5', '1.5', '3.75', 2],
            ['2.555', '1.555', '3.97', 2],
            [9.9999E-2, -5.6E-2, '-0.005599944', 9],
        ];
    }

    /**
     * @test
     * @dataProvider mulProvider
     * @param string $leftOperand
     * @param string $rightOperand
     * @param string $expected
     * @param null|int $scale
     */
    public function shouldMul($leftOperand, $rightOperand, $expected, $scale): void
    {
        self::assertSame($expected, BC::mul((string)$leftOperand, (string)$rightOperand, $scale));
    }


    public function powProvider(): array
    {
        return [
            ['256', '2', '8', 0],
            ['74.08', '4.2', '3', 2],
            ['-32', '-2', '5', 4],
            ['18446744073709551616', '2', '64', 0],
            ['-108.88', '-2.555', '5', 2],
            ['63998080023999840000.5999988', '19.9999E+2', '6', 9],
            [
                '1229984803535237425357460579824952453848609953896821302286319065669207712270213276022808840210306942692366529569453244416',
                '66',
                '66',
                0,
            ],
            ['1', '0', '0', 0],
            ['0.1', '10', '-1', 1],
            ['1.0837983867343681398392334849264865554733', '5', '0.05', 40],
            ['59.3839', '8', '1.964', 4],
            ['1', '10', '0.0000001', 0],
            ['1', '10', '0.0000001', 2],
            ['36.029', '5.1', '2.2', 3],
        ];
    }

    /**
     * @test
     * @dataProvider powProvider
     * @param string $expected
     * @param string $left
     * @param string $right
     * @param null|int $scale
     */
    public function shouldPow($expected, $left, $right, $scale = 0): void
    {
        self::assertSame($expected, BC::pow((string)$left, (string)$right, $scale));
    }

    public function logProvider(): array
    {
        return [
            [
                '0.6931471805599453094172321214581765680755001343602552541206800094933936219696947156058633269964186879',
                '2',
            ],
            [
                '2.3025850929940456840179914546843642076011014886287729760333279009675726096773524802359972050895982985',
                '10',
            ],
            [
                '-INF',
                '0',
            ],
            [
                '0',
                '1',
            ],
            [
                'NAN',
                '-1',
            ],
        ];
    }

    /**
     * @test
     * @dataProvider logProvider
     * @param string $expected
     * @param string $value
     */
    public function shouldLog($expected, $value): void
    {
        self::assertSame($expected, BC::log((string)$value));
    }

    public function expProvider(): array
    {
        return [
            [
                '298.8674009670602326720280305552958844792720557285859930698483175291494073935732314440167229005529804941',
                '5.7',
            ],
            [
                '5009718959.9179776145898629945755344777367448017822374820837617183949259570367010764387804812833108859845756998',
                '22.334645654645',
            ],
            [
                '0.3678794411714423215955237701614608674458111310317678345078368016974614957448998033571472743459196437',
                '-1',
            ],
            [
                '1',
                '0',
            ],
            [
                '1021450427617659.4094516982518620090788645038742627301331924304676748729927177787220453326541582910229003291582467933',
                3.456e1,
            ],
        ];
    }

    /**
     * @test
     * @dataProvider expProvider
     * @param string $expected
     * @param string $arg
     */
    public function shouldExp($expected, $arg): void
    {
        self::assertSame($expected, BC::exp((string)$arg));
    }

    public function factProvider(): array
    {
        return [
            ['1', 'FOO'],
            ['6', '3'],
            ['24', '4'],
            ['120', '5'],
            ['12696403353658275925965100847566516959580321051449436762275840000000000000', '55'],
            [
                '1352120101970733773067011614274819697122599483131811908183737047628177265994034132291368713461649497349302589856143133435229510116396294837506877692006315661432915834997174910826068673360566341497288989997209954743556681697531481588638027960571240359783423531512393979498023752359924002706644565826435712121847113827344984006487098528182570814184286177369204400602363840908701270850750232905962380555370342454089529954739412757066091123167095526161838186578820110955607100824438507032320782992357615916749432532447527368676631859661521238760870735527498653795183539783564690884483063180835764379492982520378977182244324512341018150509625525378905237230283986134834548153407352954715849859625768547943765161546418930836848064948451279093982894200819727754989070021704775797730750238107994872656828695516417881633934002199666960973645243375443246651301541333655652238296995689775354768542007545075142984211576541365557119557540627643329393683436387728118677828867857740757132233113516693527211814574739338293271460885570441349231351752383433352765975545204375912432594596113332741119354939353014503322387908651048263510102330371491105379688834342735823028755445146907083524895708398217607871080941341652914407671398367518509530325036889967085438794341130203490432090168747436904916918651173414472969992936827322290441286162500190109938519460450826861557230028805295622910014088032828346719679517421247715020534537700965849660883032302717019644562433150024635604762052002534028696629046990072858757588435951741887858588348113453649702435529712275328734772200798824647783552298277793615161059963699445498256000077540527301059550783529092098564446519833883557504895944421503363619527476998068362404201929345421647714763941354568414779882124491156177862842542815506817685490004739467429347446618659579953462063079757736600753871877067083965237845213240010848581504831053975434425143171746631341762195342736634638129582085373475793944488694512602143694792948257271921140153640603343096248881341215081509400288581408435215549715915260473296819413135019859948374962046712488759726342119726826901506105396218407578855410289091823224308767092452169221737093493587297758858417573680905241101368865449581132523234774846630787586927672276856400694036146591236722557130579954111692826164834542054936860327798863571665477779826251029086223483796906779089487784145495378256136425915177355034898173950147490682126470336438593281560487283159506304621370530261708627129060553915509003975468090346375866276033394920320678432457143507723107122487195374519128978668296580081062332375853436617376879980116152400514000392596929419052997064108467277989862501470384743645675198143314964216720733011237794071202653538264770997343051525931760263574123279062668951096284013681437574586191015603626739281515733205332994849968660671183273822108848740739542594997209308985543929302889180711874734873521273053528846156754996593353832701400704122512249925895034727323372449016472717793021639824951160265330662841601481925693783522925057812098900177609172565210004384736787468976183572374389866970896876729283713848904742983177352243630752419854642087694908122374322997951504415719963497682903859528697835977460808683230919315768931320321515572756803021410702219574222854791625348206167001024307602312292274062783656313069811273748388957231168299593456124069326155054222350440615253925773104703909512962614769075725229805737146418789996836311534187921166588053060653570084646462567237637902199048768915146311997127035919225466123766967732669086045035741874988471283181730605371604597281737626169543071041569095277933284149606769679089217424933371700178273937138278648458324132426529709883371763283712076074348683393641921474293431751961856826381800033652192885044485408096653004376245673073573167133545715282194839672509402656047674960172191002707776969993708883002946569483638775035028406280030045680099965963352967687712780415844194344897034867035649238735417907284480143800715923875226999988182837399775375032771365049990944279400177666169025474822560599277998078660375551951259606461334237444393907826059364572995077012696500217571481359989544121387805436811766656562426437674715462409672464285545179178656627209567861141385839660668523900041470576453589931144057302653030962570219302927462587782634610438021502841017584951874606688047253850643655244112919192792819462728160774912708068851493794723457166187479660457072589244982411564768691660373121926807493884960044548017084897020763855207653681096759142002538226845404372799721685705572634438220271114429420133733951367785285045015242008542653557707317451857972154654382589317549090816442222028837987889474372606419089374814467969896617039883595672111439205446056522484144835457023481497028559622902200558019868118246599782160047265704558098918522653452115528498393826050243781982164817504322506948067517212641792764493495897458412764877555887954848260359825696806281379301363345037981603241039149654502867961958451074927305138707709064067972599358554012791947848815290502895895860449670062560156040554849129569699278138934666508929878995893935747162189359711443358863173891265526226063435539120837625829638607194040524668720159344401629952773505778079352490821105274251986635668955237486825386746806409531711107991700074469550018959692530976626932834845278877276910533814229212661693460909241564118904928212460243057459003602392795914829610139931664352827606322648351888396817703519638140804131058812545855808475244859924876181478011379330289041290637623990235765095562678716591049279750452157666526740287900476731608369483988928999686707572922693981700802433912039899996007955549400467969054090810822620301958626526282042169285939649535367207857745108450969447098437807317727774253678971042666633565535058826907799225976904526915064162232477244522769483279502195056391311845087471891767935107410797095722827132957212481902147148757254626945121374919137154163065062186579710977767318846783049909516922471026817599405710343608499199244540993787974291529714016949175605461772769321738528529439505603179052626064457271898086735983761791376964239234728566142708083390935543815061352142697561148552832340249191226591947656969923293812987346346579553020648796718123999227633510804333685665336946322035397517106771942515502711510070956498459423946691815638510496076491288834098753445908737263754155130880000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000',
                2.349e+3,
            ],
        ];
    }

    /**
     * @test
     * @dataProvider factProvider
     * @param string $expected
     * @param string $fact
     */
    public function shouldFact($expected, $fact): void
    {
        self::assertSame($expected, BC::fact((string)$fact));
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Number has to be an integer
     */
    public function shouldFactThrowErrorOnFloat(): void
    {
        BC::fact('1.1');
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Number has to be greater than or equal to 0
     */
    public function shouldFactThrowErrorOnNegative(): void
    {
        BC::fact('-1');
    }

    /**
     * @test
     */
    public function shouldPowUsingGlobalScale(): void
    {
        BC::setScale(0);
        self::assertSame('74', BC::pow('4.2', '3'));
        self::assertSame('74.08', BC::pow('4.2', '3', 2));
        BC::setScale(2);
        self::assertSame('74', BC::pow('4.2', '3', 0));
        self::assertSame('74.08', BC::pow('4.2', '3'));
    }

    public function powModProvider(): array
    {
        return [
            ['4', '5', '2', '7', 0],
            ['-4', '-2', '5', '7', 0],
            ['790', '10', '2147483648', '2047', 0],
            ['790', 1E+1, 2E+8, 2047, 0],
            ['4', '5', '2', '7', 2],
            ['3.7', '5', '2', '7.1', 2],
            ['3.7', '5', '2', '7.1', 2],
            ['1', '4', '4', '3', 2],
            ['0.52', '5.1', '2.2', '7.1', 2],
            ['0.52', '5.1', '2.2', '7.1', 2],
        ];
    }

    /**
     * @test
     * @dataProvider powModProvider
     * @param string $expected
     * @param string $left
     * @param string $right
     * @param string $modulus
     * @param null|int $scale
     */
    public function shouldPowMod($expected, $left, $right, $modulus, $scale): void
    {
        self::assertSame($expected, BC::powMod((string)$left, (string)$right, (string)$modulus, $scale));
    }

    public function sqrtProvider(): array
    {
        return [
            ['3', '9', 0],
            ['3.07', '9.444', 2],
            ['43913234134.28826', '1928372132132819737213', 5],
            ['0.31', 9.9999E-2, 2],
        ];
    }

    /**
     * @test
     * @param string $expected
     * @param string $operand
     * @param int $scale
     * @dataProvider sqrtProvider
     */
    public function shouldSqrt($expected, $operand, $scale): void
    {
        self::assertSame($expected, BC::sqrt((string)$operand, $scale));
    }

    /**
     * @test
     */
    public function shouldSqrtUsingGlobalScale(): void
    {
        BC::setScale(0);
        self::assertSame('3', BC::sqrt('9.444'));
        self::assertSame('3.07', BC::sqrt('9.444', 2));
        BC::setScale(2);
        self::assertSame('3', BC::sqrt('9.444', 0));
        self::assertSame('3.07', BC::sqrt('9.444'));
    }

    public function hexdecProvider(): array
    {
        return [
            ['123', '7b'],
            ['1234567890', '499602d2'],
            ['12345678901234567890', 'ab54a98ceb1f0ad2'],
            ['123456789012345678901234567890', '18ee90ff6c373e0ee4e3f0ad2'],
            ['1234567890123456789012345678901234567890', '3a0c92075c0dbf3b8acbc5f96ce3f0ad2'],
        ];
    }

    /**
     * @test
     * @param string $expected
     * @param string $operand
     * @dataProvider hexdecProvider
     */
    public function shouldHexdec($expected, $operand): void
    {
        self::assertSame($expected, BC::hexdec((string)$operand));
    }

    public function dechexProvider(): array
    {
        return [
            ['7b', '123'],
            ['ffffffff', '4294967295'],
            ['200000000', '8589934592'],
            ['7fffffffffffffff', '9223372036854775807'],
            ['10000000000000000', '18446744073709551616'],
            ['18ee90ff6c373e0ee4e3f0ad2', '123456789012345678901234567890'],
        ];
    }

    /**
     * @test
     * @param string $expected
     * @param string $operand
     * @dataProvider dechexProvider
     */
    public function shouldDechex($expected, $operand): void
    {

        self::assertSame($expected, BC::dechex((string)$operand));
    }

    /**
     * @test
     * @dataProvider shouldBitAddProvider
     * @param string $expected
     * @param string $left
     * @param string $right
     */
    public function shouldBitAdd($expected, $left, $right): void
    {
        self::assertSame($expected, BC::bitAnd($left, $right));
    }

    public function shouldBitAddProvider(): array
    {
        return [
            [
                '2972225677459078825024027220918272',
                '1000000000865464564564564567867867867800000',
                '5000788676546456456458678760000000'
            ],
            ['610237752474644548', '543543543534543534543534543 ', '4213434324324234324'],
            ['0', '0', '0'],
            ['0', '0', '5'],
            ['1', '1', '5'],
            ['0', '2', '5'],
            ['4', '4', '5'],
            ['4', '-4', '5'],
            ['0', '4', '-5'],
            ['0', '8', '5'],
        ];
    }

    /**
     * @test
     * @dataProvider shouldBitOrProvider
     * @param string $expected
     * @param string $left
     * @param string $right
     */
    public function shouldBitOr($expected, $left, $right): void
    {
        self::assertSame($expected, BC::bitOr($left, $right));
    }

    public function shouldBitOrProvider(): array
    {
        return [
            [
                '1000000002894027563651942199302519406881728',
                '1000000000865464564564564567867867867800000',
                '5000788676546456456458678760000000'
            ],
            ['543543547137740106393124319', '543543543534543534543534543 ', '4213434324324234324'],
            ['0', '0', '0'],
            ['5', '0', '5'],
            ['5', '1', '5'],
            ['7', '2', '5'],
            ['5', '4', '5'],
            ['-3', '-4', '5'],
            ['-1', '4', '-5'],
            ['13', '8', '5'],
            ['-853289843298817', '-3213123123123123', '-999696956946954'],
            ['-113449967538441782579763', '-677868678631231237867786867', '-123213213123123123123123'],
        ];
    }

    /**
     * @test
     * @dataProvider shouldBitXorProvider
     * @param string $expected
     * @param string $left
     * @param string $right
     */
    public function shouldBitXor($expected, $left, $right): void
    {
        self::assertSame($expected, BC::bitXor($left, $right));
    }

    public function shouldBitXorProvider(): array
    {
        return [
            ['7', '2', '5'],
            ['-8', '3', '-5'],
            ['-6', '-4', '6'],
            ['15', '-8', '-9'],
            ['32111810161015317381218', '21312831290381290382198', '10912839021839123211028'],
            ['-2', '999999999999999999999999999999999', '-999999999999999999999999999999999'],
            ['0', '999999999999999999999999999999999', '999999999999999999999999999999999'],
            ['-2', '-999999999999999999999999999999999', '999999999999999999999999999999999'],
        ];
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Left operator has to be an integer
     */
    public function shouldThrowErrorOnFloatXorLeftOperator(): void
    {
        BC::bitXor('0.001', '1');
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Left operator has to be an integer
     */
    public function shouldThrowErrorOnFloatOrLeftOperator(): void
    {
        BC::bitOr('0.001', '1');
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Left operator has to be an integer
     */
    public function shouldThrowErrorOnFloatAndLeftOperator(): void
    {
        BC::bitAnd('0.001', '1');
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Right operator has to be an integer
     */
    public function shouldThrowErrorOnFloatXorRightOperator(): void
    {
        BC::bitXor('1', '0.001');
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Right operator has to be an integer
     */
    public function shouldThrowErrorOnFloatOrRightOperator(): void
    {
        BC::bitOr('1', '0.001');
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Right operator has to be an integer
     */
    public function shouldThrowErrorOnFloatAndRightOperator(): void
    {
        BC::bitAnd('1', '0.001');
    }

    /**
     * @test
     * @dataProvider shouldConvertBinaryProvider
     * @param string $expected
     * @param string $base64binary
     */
    public function shouldConvertBinary($expected, $base64binary): void
    {
        $decoded = base64_decode($base64binary);
        self::assertSame($expected, BC::bin2dec($decoded));
        self::assertSame($decoded, BC::dec2bin($expected));
    }

    public function shouldConvertBinaryProvider(): array
    {
        return [
            ['1000000000865464564564564567867867867800000', 'C3q8Ypr74y+H5r28hvnkbmHA'],
            ['5000788676546456456458678760000000', '9o7TsLbE7mZg8DmCSgA'],
            ['543543543534543534543534543', 'AcGb0ol63k727vnP'],
            ['2', 'Ag=='],
            ['48', 'MA==']
        ];
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Invalid Base: 300
     */
    public function shouldThrowErrorOnIncorrectBaseInBin2Dec(): void
    {
        BC::bin2dec('', 300);
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Invalid Base: 600
     */
    public function shouldThrowErrorOnIncorrectBaseInDec2Bin(): void
    {
        BC::dec2bin('1', 600);
    }

    protected function setUp(): void
    {
        BC::setScale(2);
    }
}
