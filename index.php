<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        class Train {            
            private $carsInTrain = [];
            
            function addCarToEnd($carName) {
                if ($this->getNumberOfCars() > 29) {
                    echo  'There are too many cars on this train to add another';
                }
                else {
                    array_push($this->carsInTrain, $carName);
                }
            }
            function addCarToFront($carName) {
                if ($this->getNumberOfCars() > 29) {
                    echo 'There are too many cars on this train to add another';
                }
                else {
                    array_unshift($this->carsInTrain, $carName);
                }
            }
            function removeCarFromFront() {
                if ($this->getNumberOfCars() === 0) {
                    echo 'There is no car here to remove.';
                }
                else {
                    array_shift($this->carsInTrain);
                }
            }
            function removeCarFromEnd() {
                if ($this->getNumberOfCars() === 0) {
                    echo 'There is no car here to remove.';
                }
                else {
                    array_pop($this->carsInTrain);
                }
            }
            
            public function accessCarInTrain($positionOfCar) {
                if ($positionOfCar > $this->getNumberOfCars()) {
                    echo 'There is no car at this position.';
                }
                else {
                    return $this->carsInTrain[$positionOfCar];
                }               
            }
            /* allows access to the public functions of a TrainCar by its
             * position in $carsInTrain
             */                        
            function getNumberOfCars() {
                $numberOfCars = count($this->carsInTrain);
                return $numberOfCars;
            }
        }
        class TrainCar {

            private $name = '';
            protected $weightInTons = null;
            function __construct($weightValueInTons, $carName) {
                if (($weightValueInTons <= 0) || ($carName === '')) {
                    echo 'New cars must have a weight value greater than zero and a non-empty name.';
                }
                else {
                    $this->weightInTons = $weightValueInTons;
                    $this->name = $carName;
                }                
            }           
            protected function setCarWeight($newWeightValue) {
                if ($newWeightValue <= 0) {
                    echo 'The weight of a car must be greater than zero.';
                }
                $this->weightInTons = $newWeightValue;            
            }
            public function getCarWeight() {
                if ($this->weightInTons === null) {
                    echo 'This car has an uninitialized weight.';
                    return 0;
                }
                return $this->weightInTons;
            }
            public function getCarName() {
                if($this->name === '') {
                    return 'This car has not been given a name.';
                }
                return $this->name;
            }

        }
        
        
        $testTrain = new Train();
        $testTrain->removeCarFromFront();
        //demonstrates the error that occurs if there are no cars to remove.
        $weightOfTrain = 0;
            for ($car = 0; $car < 30; $car++) {               
                $weight = 40 - $car; //a variety of weights
                $Cars[$car] = new TrainCar($weight, "Car {$car}"); //unique names
                $testTrain->addCarToEnd($Cars[$car]);
                $weightOfTrain += $weight;
            }
        echo "<br>";    
        echo 'The number of cars is: ' . $testTrain->getNumberOfCars() . "<br>";
        echo $testTrain->accessCarInTrain(0)->getCarName() . ', ';
        echo 'weighing ' . $testTrain->accessCarInTrain(0)->getCarWeight() . ' tons. ';
        //name and weight of the the first car on the train and:        
        echo 'The total weight is:' . $weightOfTrain . ' tons.';
        //the current weight of the the train.
        echo "<br>";
        $weightOfTrain -= $testTrain->accessCarInTrain(0)->getCarWeight();
        $testTrain->removeCarFromFront();
        $weightOfTrain -= $testTrain->accessCarInTrain(28)->getCarWeight();
        $testTrain->removeCarFromEnd();
        echo $testTrain->accessCarInTrain(0)->getCarName() . ', ';
        echo 'weighing ' . $testTrain->accessCarInTrain(0)->getCarWeight() . ' tons.';
        /*the index of each car has been updated by array_shift
        the name of the car stays the same, so in this case the car at index 0 is named
        "Car 1"*/
        echo 'The total weight is:' . $weightOfTrain . ' tons.' . "<br>";
        echo 'The number of cars is: ' . $testTrain->getNumberOfCars() . "<br>";
        ?>
    </body>
</html>
