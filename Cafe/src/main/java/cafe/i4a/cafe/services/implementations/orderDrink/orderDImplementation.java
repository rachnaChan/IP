package cafe.i4a.cafe.services.implementations.orderDrink;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import cafe.i4a.cafe.models.orderDrink.orderedD;
import cafe.i4a.cafe.repositories.orderDrink.orderDRepository;
import cafe.i4a.cafe.services.orderDrink.orderDService;

@Service
public class orderDImplementation implements orderDService {

    @Autowired
    private orderDRepository orderRpositories;

    @Override
    public List<orderedD> getAllOrder() {
        return orderRpositories.findAll();
    }

    @Override
    public orderedD saveOrdered(orderedD orderedd) {
        return this.orderRpositories.save(orderedd);
    }

    @Override
    public orderedD updateVieId(Long id, orderedD newOrder) {
        orderedD existDrink = new orderedD();
        existDrink = orderRpositories.findById(id).get();
        existDrink.setName(newOrder.getName());
        existDrink.setSize(newOrder.getSize());
        existDrink.setAmount(newOrder.getAmount());
        existDrink.setPrice(newOrder.getPrice());

        return orderRpositories.save(newOrder);

    }

    @Override
    public orderedD getOrderedById(Long id) {
        return orderRpositories.findById(id).orElse(null);
    }

}