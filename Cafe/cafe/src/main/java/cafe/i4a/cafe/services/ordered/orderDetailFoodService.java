package cafe.i4a.cafe.services.ordered;

import java.util.List;

import cafe.i4a.cafe.models.orderDetailFood.orderedDetailFoods;

public interface orderDetailFoodService {
    
    List<orderedDetailFoods> getAllOrderedFood();
    orderedDetailFoods saveOrderedFood(orderedDetailFoods orderedFood);
    orderedDetailFoods getOrderedFoodById(Long id);
}
