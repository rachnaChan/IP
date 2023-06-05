package cafe.i4a.cafe.services.ordered;

import java.util.List;

import cafe.i4a.cafe.models.ordered.ordered;

public interface orderedService {
    List<ordered> getAllOrdered();
    ordered saveOrdered(ordered ordereds);
    ordered getOrderedById(Long id);
}
