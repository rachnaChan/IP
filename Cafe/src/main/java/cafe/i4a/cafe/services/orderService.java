package cafe.i4a.cafe.services;

import java.util.List;


import cafe.i4a.cafe.models.ordered;

public interface orderService {

    List<ordered> getAllOrder();

    ordered saveOrdered(ordered orderss);

    ordered getOrderedById(Long id);

    ordered updateVieId(Long id, ordered newOrdered);

}