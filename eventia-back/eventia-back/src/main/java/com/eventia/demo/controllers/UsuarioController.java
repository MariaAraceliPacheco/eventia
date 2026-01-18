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

import com.eventia.demo.dto.usuarios.UsuarioInsertDTO;
import com.eventia.demo.dto.usuarios.UsuarioUpdateDTO;
import com.eventia.demo.entidades.Usuario;
import com.eventia.demo.services.UsuarioService;

@RestController
@RequestMapping("/usuarios")
public class UsuarioController {
	private final UsuarioService service;

	public UsuarioController(UsuarioService service) {
		this.service = service;
	}

	@GetMapping
	public List<Usuario> listar() {
		return service.obtenerTodos();
	}

	@GetMapping("/{id}")
	public Usuario buscar(@PathVariable int id) {
		return service.obtenerPorId(id);
	}

	@PostMapping(consumes = MediaType.APPLICATION_JSON_VALUE)
	public Usuario crear(@RequestBody UsuarioInsertDTO dto) {
		return service.crear(dto);
	}

	@PutMapping("/{id}")
	public Usuario actualizar(@PathVariable int id, @RequestBody UsuarioUpdateDTO dto) {
		return service.modificar(id, dto);
	}

	@DeleteMapping("/{id}")
	public ResponseEntity<Void> eliminar(@PathVariable int id) {
		service.eliminar(id);
		return ResponseEntity.noContent().build();
	}
}
