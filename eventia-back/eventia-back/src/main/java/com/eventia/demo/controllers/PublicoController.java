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

import com.eventia.demo.dto.publico.PublicoDTO;
import com.eventia.demo.dto.publico.PublicoInsertDTO;
import com.eventia.demo.entidades.Publico;
import com.eventia.demo.services.PublicoService;

@RestController
@RequestMapping("/publico")
public class PublicoController {
	private final PublicoService service;

	public PublicoController(PublicoService service) {
		this.service = service;
	}

	@GetMapping
	public List<Publico> listar() {
		return service.obtenerTodos();
	}

	@GetMapping("/{id}")
	public Publico buscar(@PathVariable int id) {
		return service.obtenerPorId(id);
	}

	@PostMapping(consumes = MediaType.APPLICATION_JSON_VALUE)
	public Publico crear(@RequestBody PublicoInsertDTO dto) {
		return service.crear(dto);
	}

	@PutMapping("/{id}")
	public Publico actualizar(@PathVariable int id, @RequestBody PublicoDTO dto) {
		return service.modificar(id, dto);
	}

	@DeleteMapping("/{id}")
	public ResponseEntity<Void> eliminar(@PathVariable int id) {
		service.eliminar(id);
		return ResponseEntity.noContent().build();
	}
}
