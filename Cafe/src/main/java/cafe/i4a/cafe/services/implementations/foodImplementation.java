package cafe.i4a.cafe.services.implementations;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import cafe.i4a.cafe.models.food;
import cafe.i4a.cafe.repositories.foodRepository;
import cafe.i4a.cafe.services.foodService;

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
        return foodRepository.findById(id).orElse(null);
    }

    @Override
    public food updateVieId(Long id, food newFood) {
        food existFood = new food();
        existFood = foodRepository.findById(id).get();
        existFood.setName(newFood.getName());
        existFood.setPrice(newFood.getPrice());
        existFood.setImage(newFood.getImage());

        return foodRepository.save(newFood);
    }

}
