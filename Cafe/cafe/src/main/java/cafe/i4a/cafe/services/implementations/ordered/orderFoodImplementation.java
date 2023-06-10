package cafe.i4a.cafe.services.implementations.ordered;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import cafe.i4a.cafe.models.orderDetailFood.orderedDetailFoods;
import cafe.i4a.cafe.repositories.ordered.orderFoodRepository;
import cafe.i4a.cafe.services.ordered.orderDetailFoodService;

@Service
public class orderFoodImplementation implements orderDetailFoodService{

    @Autowired
    orderFoodRepository orderFoodRepositories;

    @Override
    public List<orderedDetailFoods> getAllOrderedFood() {
        return orderFoodRepositories.findAll();
    }

    @Override
    public orderedDetailFoods saveOrderedFood(orderedDetailFoods orderedFood) {
       return this.orderFoodRepositories.save(orderedFood);
    }

    @Override
    public orderedDetailFoods getOrderedFoodById(Long id) {
       return orderFoodRepositories.findById(id).get();
    }
    
    // @Override
    // public orderedDetailFoods updateVieId(Long id, orderedDetailFoods neworderDetailFoods) {
    //     orderedDetailFoods existorderedFood = new orderedDetailFoods();
    //     existorderedFood = orderFoodRepositories.findById(id).get();
    //     existorderedFood.setAmount(neworderDetailFoods.getAmount());

        

    //     return orderFoodRepositories.save(neworderDetailFoods);
    // }
}
