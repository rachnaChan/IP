package cafe.i4a.cafe.services.implementations.orderFood;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import cafe.i4a.cafe.models.orderFood.orderedF;
import cafe.i4a.cafe.repositories.orderFood.orderFRepository;
import cafe.i4a.cafe.services.orderFood.orderFService;

@Service
public class orderFImplementation implements orderFService {

    @Autowired
    private orderFRepository orderRpositories;

    @Override
    public List<orderedF> getAllOrder() {
        return orderRpositories.findAll();
    }

    @Override
    public orderedF saveOrdered(orderedF orderedd) {
        return this.orderRpositories.save(orderedd);
    }

    @Override
    public orderedF updateVieId(Long id, orderedF newOrder) {
        orderedF existDrink = new orderedF();
        existDrink = orderRpositories.findById(id).get();
        existDrink.setName(newOrder.getName());
        existDrink.setAmount(newOrder.getAmount());
        existDrink.setPrice(newOrder.getPrice());

        return orderRpositories.save(newOrder);

    }

    @Override
    public orderedF getOrderedById(Long id) {
        return orderRpositories.findById(id).orElse(null);
    }

}