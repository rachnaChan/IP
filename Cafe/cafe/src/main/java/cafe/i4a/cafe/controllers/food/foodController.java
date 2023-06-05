package cafe.i4a.cafe.controllers.food;

import java.util.Base64;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.multipart.MultipartFile;
import org.springframework.util.StringUtils;

import cafe.i4a.cafe.models.food.food;
import cafe.i4a.cafe.repositories.food.foodRepository;
import cafe.i4a.cafe.services.food.foodService;

@Controller
public class foodController {

    @Autowired
    private foodService foodServices;

    @Autowired
    private foodRepository foodRepositories;

    public foodController(foodService foodServices){
        super();
        this.foodServices = foodServices;
    }

    @GetMapping("/listFood")
    public String listfood(Model model){
        model.addAttribute("foods", foodServices.getAllFood());
        return "food/listFood";
    }

    @RequestMapping(value = "/addFood", method= RequestMethod.GET)
    public String addFood(Model model){
        model.addAttribute("foods", new food());
        return "food/addFood";

    }

    
    @PostMapping("/addFood")
    public String addFoods(@ModelAttribute("foods") food food, @RequestParam("file") MultipartFile file) {
        String fileName = StringUtils.cleanPath(file.getOriginalFilename());
        if (fileName.contains("..")) {
            System.out.println("not valid");
        }

        try {
            food.setImage(Base64.getEncoder().encodeToString(file.getBytes()));

        } catch (Exception e) {

        }
        foodServices.saveFood(food);
        return "redirect:/addFood?success";
    }

    @GetMapping("/deleteFood/{id}")
    public String deleteFoodk(@PathVariable("id") Long id) {
        foodRepositories.deleteById(id);
        return "redirect:/listFood";

    }

    @GetMapping("/editFood/{id}")
    public String editFoods(@PathVariable("id") Long id, @ModelAttribute("foods") food food, Model model) {
        food existFood = foodServices.getFoodById(id);
        model.addAttribute("foods", existFood);
        return "food/editFoods";
    }

    @PostMapping("/editFood/{id}")
    public String updateFoods(@PathVariable("id") Long id, @ModelAttribute("foods") food food,
            @RequestParam("file") MultipartFile file) {

            food existedFood = foodServices.getFoodById(id);
        String fileName = StringUtils.cleanPath(file.getOriginalFilename());
        if (fileName.contains("..")) {
            System.out.println("not valid");
        }

        try {
            food.setId(id);

            if(fileName == ""){
                food.setImage(existedFood.getImage());
            }else{
                food.setImage(Base64.getEncoder().encodeToString(file.getBytes()));
            }

        } catch (Exception e) {

        }
        foodServices.saveFood(food);
        return "redirect:/listFood";
    }  
}
