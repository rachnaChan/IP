package cafe.i4a.cafe.controllers.table;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;

import cafe.i4a.cafe.models.table.table;
import cafe.i4a.cafe.services.table.tableService;

@Controller
public class tableController {

    @Autowired
    private tableService tableService;

    @GetMapping("/tableSelection")
    public String tableSelection(Model model) {
        model.addAttribute("tables", tableService.getAllTables());
        return "table/tableSelection";
    }

    @RequestMapping(value = "/addTable", method = RequestMethod.GET)
    public String tables(Model model) {
        model.addAttribute("tables", new table());
        return "table/addTable";
    }

    @GetMapping("/listTable")
    public String showTables(Model model) {
        model.addAttribute("tables", tableService.getAllTables());
        return "table/listTable";
    }

    @PostMapping("/addTable")
    public String addTables(@ModelAttribute("tables") table tables) {

        tableService.saveTables(tables);
        return "redirect:/addTable?success";
    }

    @GetMapping("/editTable/{id}")
    public String editTables(@PathVariable("id") Long id, @ModelAttribute("tables") table tables, Model model) {
        table existTable = tableService.getTableById(id);
        model.addAttribute("tables", existTable);
        return "table/editTables";
    }


    @PostMapping("/editTable/{id}")
    public String updateTables(@PathVariable("id") Long id, @ModelAttribute("tables") table tables) {

        tableService.saveTables(tables);
        return "table/editTables";
    }
}
