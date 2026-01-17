package com.eventia.demo.controllers;

import java.util.List;

import org.springframework.http.MediaType;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.eventia.demo.dto.EventoInsertDTO;
import com.eventia.demo.dto.eventos.EventoUpdateDTO;
import com.eventia.demo.entidades.Evento;
import com.eventia.demo.services.EventoService;

@RestController
@RequestMapping("/eventos")
public class EventoController {
	private final EventoService service;

    public EventoController(EventoService service) {
        this.service = service;
    }

    @PostMapping(consumes = MediaType.APPLICATION_JSON_VALUE)
    public Evento crear(@RequestBody EventoInsertDTO dto) {
        return service.crear(dto);
    }
    
    @GetMapping("/{id}")
	public Evento buscar(@PathVariable int id) {
		return service.obtenerPorId(id);
	}
    
    @GetMapping
    public List<Evento> listar() {
        return service.obtenerTodos();
    }

    @DeleteMapping("/{id}")
	public ResponseEntity<Void> eliminar(@PathVariable int id) {
		service.eliminar(id);
		return ResponseEntity.noContent().build();
	}
    @PutMapping("/{id}")
	public Evento actualizar(@PathVariable int id, @RequestBody EventoUpdateDTO dto) {
		return service.modificar(id, dto);
	}
}
