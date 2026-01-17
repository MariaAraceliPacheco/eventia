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

import com.eventia.demo.dto.ayuntamientos.AyuntamientoInsertDTO;
import com.eventia.demo.dto.ayuntamientos.AyuntamientoUpdateDTO;
import com.eventia.demo.entidades.Ayuntamiento;
import com.eventia.demo.services.AyuntamientoService;


@RestController
@RequestMapping("/ayuntamiento")
public class AyuntamientoController {
	private final AyuntamientoService service;

	public AyuntamientoController(AyuntamientoService service) {
		this.service = service;
	}

	@GetMapping
	public List<Ayuntamiento> listar() {
		return service.obtenerTodos();
	}

	@GetMapping("/{id}")
	public Ayuntamiento buscar(@PathVariable int id) {
		return service.obtenerPorId(id);
	}

	@PostMapping(consumes = MediaType.APPLICATION_JSON_VALUE)
	public Ayuntamiento crear(@RequestBody AyuntamientoInsertDTO dto) {
		return service.crear(dto);
	}

	@PutMapping("/{id}")
	public Ayuntamiento actualizar(@PathVariable int id, @RequestBody AyuntamientoUpdateDTO dto) {
		return service.modificar(id, dto);
	}

	@DeleteMapping("/{id}")
	public ResponseEntity<Void> eliminar(@PathVariable int id) {
		service.eliminar(id);
		return ResponseEntity.noContent().build();
	}
}
