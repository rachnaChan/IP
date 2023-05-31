package cafe.i4a.cafe.services.orderFood;

import java.util.List;

import cafe.i4a.cafe.models.orderFood.orderedF;

public interface orderFService {

    List<orderedF> getAllOrder();

    orderedF saveOrdered(orderedF orderss);

    orderedF getOrderedById(Long id);

    orderedF updateVieId(Long id, orderedF newOrdered);

}