package cafe.i4a.cafe.services.food;

import java.util.List;

import cafe.i4a.cafe.models.food.food;

public interface foodService {

    List<food> getAllFood();

    food saveFood(food food);

    food getFoodById(Long id);
    
    food updateVieId(Long id, food newFood);
    
}
