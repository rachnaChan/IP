package cafe.i4a.cafe.services.implementations.ordered;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import cafe.i4a.cafe.models.orderDetailDrink.orderedDetailDrinks;
import cafe.i4a.cafe.repositories.ordered.orderDrinkRepository;
import cafe.i4a.cafe.services.ordered.orderDetailDrinkService;

@Service
public class orderDrinkImplementation implements orderDetailDrinkService {

    @Autowired
    orderDrinkRepository orderedDrinkRepositories;

    @Override
    public List<orderedDetailDrinks> getAllOrderedDrink() {
        return orderedDrinkRepositories.findAll();
        
    }

    @Override
    public orderedDetailDrinks saveOrderedDrink(orderedDetailDrinks orderedDrink) {
       return this.orderedDrinkRepositories.save(orderedDrink);
    }


    @Override
    public orderedDetailDrinks getOrderedDrinkById(long id) {
       return orderedDrinkRepositories.findById(id).orElse(null);
    }
    
}
