<?php
// Simple Calculator met functies en loop

// Leest invoer uit de terminal (werkt ook op Windows/WAMP waar readline() ontbreekt)
function readInput(string $prompt): string
{
    if (function_exists('readline')) {
        return (string)readline($prompt);
    }
    echo $prompt;
    return (string)fgets(STDIN);
}

// Vraagt om een getal en blijft vragen tot de invoer geldig is
function getNumber(string $prompt): float
{
    while (true) {
        $input = trim(readInput($prompt));
        if (is_numeric($input)) {
            return (float)$input;
        }
        echo "Invalid number, try again.\n";
    }
}

// Vraagt om een operator en blijft vragen tot de invoer geldig is
function getOperation(): string
{
    $validOperations = ["+", "-", "*", "/"];
    while (true) {
        $operation = trim(readInput("Enter operation (+, -, *, /): "));
        if (in_array($operation, $validOperations, true)) {
            return $operation;
        }
        echo "Invalid operation, try again.\n";
    }
}

// Voert de berekening uit
function calculate(float $num1, float $num2, string $operation): float|string
{
    switch ($operation) {
        case "+":
            return $num1 + $num2;
        case "-":
            return $num1 - $num2;
        case "*":
            return $num1 * $num2;
        case "/":
            if ($num2 == 0) {
                return "Error: Division by zero!";
            }
            return $num1 / $num2;
        default:
            return "Invalid operation!";
    }
}

// Vraagt of de gebruiker opnieuw wil rekenen
function askAgain(): bool
{
    $answer = strtolower(trim(readInput("Calculate again? (y/n): ")));
    return $answer === "y" || $answer === "yes" || $answer === "j" || $answer === "ja";
}

// Hoofdprogramma (loop)
echo "Simple Calculator\n";

do {
    $num1 = getNumber("Enter first number: ");
    $operation = getOperation();
    $num2 = getNumber("Enter second number: ");
    $result = calculate($num1, $num2, $operation);
    echo "Result: $result\n\n";
} while (askAgain());

echo "Goodbye!\n";
?>
