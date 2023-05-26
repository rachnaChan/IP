
package cafe.i4a.cafe.services.implementations.ordered;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import cafe.i4a.cafe.models.ordered.ordered;
import cafe.i4a.cafe.repositories.ordered.orderedRepository;
import cafe.i4a.cafe.services.ordered.orderedService;

@Service
public class orderedImplementation implements orderedService{

    @Autowired
    orderedRepository orderedRepositories;

    @Override
    public List<ordered> getAllOrdered() {
        return orderedRepositories.findAll();
        
    }

    @Override
    public ordered saveOrdered(ordered ordereds) {
       return this.orderedRepositories.save(ordereds);
    }


    @Override
    public ordered getOrderedById(long id) {
       return orderedRepositories.findById(id).orElse(null);
    }
}