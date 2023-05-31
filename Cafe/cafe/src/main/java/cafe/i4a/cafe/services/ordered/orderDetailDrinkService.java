package cafe.i4a.cafe.services.ordered;

import java.util.List;

import cafe.i4a.cafe.models.orderDetailDrink.orderedDetailDrinks;

public interface orderDetailDrinkService {
    List<orderedDetailDrinks> getAllOrderedDrink();
    orderedDetailDrinks saveOrderedDrink(orderedDetailDrinks orderedDrink);
    orderedDetailDrinks getOrderedDrinkById(long id);   
}
