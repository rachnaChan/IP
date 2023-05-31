package cafe.i4a.cafe.services.orderDrink;

import java.util.List;

import cafe.i4a.cafe.models.orderDrink.orderedD;

public interface orderDService {

    List<orderedD> getAllOrder();

    orderedD saveOrdered(orderedD orderss);

    orderedD getOrderedById(Long id);

    orderedD updateVieId(Long id, orderedD newOrdered);

}