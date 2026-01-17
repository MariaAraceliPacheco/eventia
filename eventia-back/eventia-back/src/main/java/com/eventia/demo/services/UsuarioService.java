package com.eventia.demo.services;

import org.springframework.stereotype.Service;

import com.eventia.demo.dto.UsuarioInsertDTO;
import com.eventia.demo.entidades.Usuario;
import com.eventia.demo.repositories.UsuarioRepository;

@Service
public class UsuarioService {
	private final UsuarioRepository usuarioRepo;

    public UsuarioService(UsuarioRepository usuarioRepo) {
        this.usuarioRepo = usuarioRepo;
    }

    public Usuario crear(UsuarioInsertDTO dto) {
        Usuario u = new Usuario();
        u.setNombre(dto.getNombre());
        u.setEmail(dto.getEmail());
        u.setPassword(dto.getPassword());
        u.setTipoUsuario(dto.getTipo_usuario());
        return usuarioRepo.save(u);
    }
}
