package cafe.i4a.cafe.services.implementations;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import cafe.i4a.cafe.services.orderService;
import cafe.i4a.cafe.repositories.orderRepository;
import cafe.i4a.cafe.models.ordered;

@Service
public class orderImplementation implements orderService {

    @Autowired
    private orderRepository orderRpositories;

    @Override
    public List<ordered> getAllOrder() {
        return orderRpositories.findAll();
    }

    @Override
    public ordered saveOrdered(ordered orderedd) {
        return this.orderRpositories.save(orderedd);
    }

    @Override
    public ordered updateVieId(Long id, ordered newOrder) {
        ordered existDrink = new ordered();
        existDrink = orderRpositories.findById(id).get();
        existDrink.setName(newOrder.getName());
        existDrink.setSize(newOrder.getSize());
        existDrink.setPrice(newOrder.getPrice());

        return orderRpositories.save(newOrder);

    }

    @Override
    public ordered getOrderedById(Long id) {
        return orderRpositories.findById(id).orElse(null);
    }

}