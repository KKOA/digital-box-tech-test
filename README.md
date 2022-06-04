# PHP tech test
This is my solution for the below requirement.

## Test Requirements
Write some code to calculate a result from a set of instructions.  Instructions comprise of a keyword and a number that are separated by a space per line.  Instructions are loaded from file and results are output to the screen. Any number of Instructions can be specified. Instructions can be any binary operators of your choice (e.g., add, divide, subtract, multiply etc).  The instructions will ignore mathematical precedence. The last instruction should be “apply” and a number (e.g., “apply 3”). The calculator is then initialised with that number and the previous instructions are applied to that number.

Examples of the calculator lifecycle might be:
### Examples

#### Example1
Input from file<br>
add 2<br>
multiply 3<br>
apply 3<br>
Output to screen<br>
15

Explanation<br>
(3 + 2) * 3 = 15

#### Example 2.
Input from file<br>
multiply 9<br>
apply 5<br>
Output to screen<br>
45

Explanation<br>
5 * 9 = 45

#### Example 3.
Input from file<br>
apply 1<br>
Output to screen<br>
1

## Assumptions
Below are the lists of assumptions for the tech challenge:
- Assume that  if instruction “apply” is not found, then the program is stopped from executing
- Ignore “divide” instruction if divisor is 0.
- If the file is not found or is not readable then display error message.
- If no number is given on the same line as the “apply” instruction then set initial value to zero.
- No binary operator instruction is executed if there is no corresponding number.
- Instructions loaded from file can be case insensitive.
- As no language is specified, I have chosen PHP as the coding language.
- It is not specified whether the filename needs to be hard coded or entered by the user. The program allows the user to enter file as the second argument. A default file name is set if no argument is passed.

## Requirements
This application was written on a machine running Mac Operating System and PHP Version 7.1.7. However the minimum requirement is a machine running PHP version 5.2 or later.

## Folder Structure
The zip folder contains
- main.php
- instructions.txt
- instructions2.txt

## How to run the application
After copying the Tech test folder, open your terminal/command prompt.
Navigate to where you have installed the files.

```
php main.php
```

By default this output the total for instructions.txt.

 You can specify the file that the program should run against  in the command prompt/ terminal by adding filename as a second argument. E.g.
```
php main.php instruction2.txt
```
***The file must be located in same directory as main.php**


