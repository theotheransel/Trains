<?php
namespace PartII;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        /*PART II: variant TrainCar types
        My solution the problem of specific types of TrainCar is to use an
        abstract class for the generic case. All types of Train car 
         such as FreightCars, PassengerCars, etc inherit the properties and methods of
         the abstract base class.  */
        
        class Train {            
            private $carsInTrain = [];
            
            public function addCarToEnd($carName) {
                if ($this->getNumberOfCars() > 29) {
                    echo  'There are too many cars on this train to add another';
                }
                else {
                    array_push($this->carsInTrain, $carName);
                }
            }
            public function addCarToFront($carName) {
                if ($this->getNumberOfCars() > 29) {
                    echo 'There are too many cars on this train to add another';
                }
                else {
                    array_unshift($this->carsInTrain, $carName);
                }
            }
            public function removeCarFromFront() {
                if ($this->getNumberOfCars() === 0) {
                    echo 'There is no car here to remove.';
                }
                else {
                    array_shift($this->carsInTrain);
                }
            }
            public function removeCarFromEnd() {
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
             public function getNumberOfCars() {
                $numberOfCars = count($this->carsInTrain);
                return $numberOfCars;
            }
            
            public function getWeightOfTrain() {
                $weight = 0;
                for ($carIndex = 0; $carIndex < $this->getNumberOfCars(); $carIndex++) {
                    $weight += $this->accessCarInTrain($carIndex)->getCarWeight();
                }
                return $weight;
            }
        }
        
        abstract class TrainCar {

            protected $name = '';
            protected $weightInTons = null;
            protected $typeOfCar = 'Generic';
            function __construct($weightValueInTons, $carName) {
                if (($weightValueInTons <= 0) || ($carName === '')) {
                    echo 'New cars must have a weight value greater than zero and a non-empty name.';
                }
                else {
                    $this->weightInTons = $weightValueInTons;
                    $this->name = $carName;
                }
            }            
            public function setCarWeight($newWeightValue) {
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
            public function getCarType() {
                return $this->typeOfCar;
            }
            // I add a function to get the type of TrainCar that this is
        }
        
        class FreightCar extends TrainCar {
            protected $typeOfCar = 'Freight Car';
            private $cargo = [];
            //adding a new property to this version of TrainCar
            public function __construct($weightValueInTons, $carName) {
                parent::__construct($weightValueInTons, $carName);
            }
            public function addToCargo($cargo) {
                array_push($this->cargo, $cargo);
            }
            public function getCargo($index) {
                return $this->cargo[$index];
            }            
        }
        
        $testTrain = new Train();
        $testTrain->removeCarFromFront();
            for ($car = 0; $car < 30; $car++) {               
                $weight = 40 - $car;
                $Cars[$car] = new FreightCar($weight, "Freight Car {$car}");
                $testTrain->addCarToEnd($Cars[$car]);
            }
        echo "<br>";    
        echo 'The number of cars is: ' . $testTrain->getNumberOfCars() . "<br>";
        echo $testTrain->accessCarInTrain(0)->getCarName() . ', ';
        echo 'weighing ' . $testTrain->accessCarInTrain(0)->getCarWeight() . ' tons. ';
        echo 'The total weight is:' . $testTrain->getWeightOfTrain() . ' tons.';
        echo "<br>";
        $testTrain->removeCarFromFront();
        $testTrain->removeCarFromEnd();
        echo $testTrain->accessCarInTrain(0)->getCarName() . ', ';
        echo 'weighing ' . $testTrain->accessCarInTrain(0)->getCarWeight() . ' tons.';
        echo 'The total weight is:' . $testTrain->getWeightOfTrain() . ' tons.' . "<br>";
        echo 'The number of cars is: ' . $testTrain->getNumberOfCars() . "<br>";
        
        /* The test example, only modified to instantiate instances of FreightCar rather than TrainCar,
         * produces the same result as in Part I. Cargo can be added to instances of FreightCar by position in
         *  the array $Cars[], or by using the Train's accessCarInTrain() function.
         */
        $testTrain->accessCarInTrain(5)->addToCargo('1000 Jars of Pickles');
        echo $testTrain->accessCarInTrain(5)->getCargo(0);        
        ?>
    </body>
</html>
