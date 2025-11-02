# Contributing to HMS Project

Thank you for considering contributing to the Hospital Management System!

## How to Contribute

### Reporting Bugs

1. Check if the bug has already been reported in Issues
2. Create a new issue with:
   - Clear title and description
   - Steps to reproduce
   - Expected vs actual behavior
   - Screenshots if applicable
   - Environment details (OS, PHP version, etc.)

### Suggesting Features

1. Check existing feature requests
2. Create a new issue with:
   - Clear description of the feature
   - Use cases and benefits
   - Possible implementation approach

### Pull Requests

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Make your changes
4. Write or update tests if applicable
5. Update documentation
6. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
7. Push to the branch (`git push origin feature/AmazingFeature`)
8. Open a Pull Request

## Development Guidelines

### Code Style

- Follow PSR-12 coding standards
- Use meaningful variable and function names
- Add comments for complex logic
- Keep functions small and focused

### Database Changes

- Always create migrations for schema changes
- Never modify existing migrations
- Test migrations both up and down

### API Development

- Follow RESTful conventions
- Use proper HTTP status codes
- Return consistent JSON responses
- Document all new endpoints

### Testing

- Write unit tests for models
- Test API endpoints
- Verify database operations
- Check edge cases

### Commit Messages

Use clear and descriptive commit messages:

```
Add patient search functionality

- Implement search by name, phone, email
- Add query parameter validation
- Update API documentation
```

### Branch Naming

- `feature/` - New features
- `bugfix/` - Bug fixes
- `hotfix/` - Urgent production fixes
- `docs/` - Documentation updates

## Code Review Process

1. All PRs require review before merging
2. Address review comments promptly
3. Keep PRs focused and reasonably sized
4. Update your PR based on feedback

## Community Guidelines

- Be respectful and constructive
- Help others learn and grow
- Follow the Code of Conduct
- Ask questions if unsure

## Getting Help

- Check existing documentation
- Search closed issues
- Ask in GitHub Discussions
- Contact maintainers

## License

By contributing, you agree that your contributions will be licensed under the MIT License.

## Recognition

Contributors will be acknowledged in the project README.

Thank you for making HMS better!
