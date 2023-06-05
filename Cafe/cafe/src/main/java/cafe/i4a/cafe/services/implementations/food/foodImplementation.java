package cafe.i4a.cafe.services.implementations.food;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import cafe.i4a.cafe.models.food.food;
import cafe.i4a.cafe.repositories.food.foodRepository;
import cafe.i4a.cafe.services.food.foodService;

@Service
public class foodImplementation implements foodService {

    @Autowired
    private foodRepository foodRepository;

    @Override
    public List<food> getAllFood() {
        return foodRepository.findAll();
    }

    @Override
    public food saveFood(food food) {
        return this.foodRepository.save(food);
    }

    @Override
    public food getFoodById(Long id) {
        return foodRepository.findById(id).get();
    }

    @Override
    public food updateVieId(Long id, food newFood) {
        food existFood = new food();
        existFood = foodRepository.findById(id).get();
        existFood.setName(newFood.getName());
        existFood.setPrice(newFood.getPrice());

        if(newFood.getImage() != null){
         existFood.setImage(newFood.getImage());   
        }
        

        return foodRepository.save(newFood);
    }

}
